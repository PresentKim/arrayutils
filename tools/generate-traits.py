#!/usr/bin/env python3
"""
Generates the method traits in src/kim/present/lib/arrayutils/traits/

Every ArrayUtils method exists in up to four variants (name, nameAs, nameFrom, nameFromAs) that only differ in
where the array comes from and what is returned. Writing them by hand is repetitive and error-prone,
so they are described once below (see spec()) and generated.

Usage:
    python3 tools/generate-traits.py           Rewrite the trait files
    python3 tools/generate-traits.py --check   Exit with 1 if the trait files are not up to date (used by CI)

To change a method, edit the spec in this file and run the script. Do not edit the generated trait files by hand.
"""
import os
import re
import sys

ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
SRC = os.path.join(ROOT, "src", "kim", "present", "lib", "arrayutils")
OUT = os.path.join(SRC, "traits")
DOC = "https://arrayutils.docs.present.kim/methods/"

with open(os.path.join(SRC, "ArrayUtils.php"), encoding="utf-8") as f:
    HEADER = f.read().split("declare(strict_types=1);")[0]
HEADER = re.sub(r"\n \* @noinspection.*", "", HEADER).rstrip()
assert HEADER.endswith("*/")
HEADER = HEADER[:-2].rstrip()

FUNCS = """array_filter array_key_last array_map array_reduce array_chunk array_column array_key_exists array_combine array_count_values array_diff array_diff_assoc array_diff_key
array_fill_keys array_flip array_intersect array_intersect_assoc array_intersect_key array_keys array_merge array_pad
array_pop array_push array_replace_recursive array_reverse array_search array_shift array_slice array_splice array_sum
array_unique array_unshift array_values count end implode in_array is_array key ksort max min random_int sort uksort
usort""".split()

# kind: "A" => array result (instance/As/From/FromAs), "V" => value result (instance/From)
# expr: single expression using $a (the input array); core: statement body using $array
# ret: return type (V only)
M = {}
def indent(text, n):
    return "\n".join((" " * n + l) if l.strip() else "" for l in text.split("\n"))

def expand(core, tiers):
    """Duplicates a callback loop per callback arity so the callback only receives the arguments it declares.
    tiers: [(max arity, number of arguments, native fast path code or None)]"""
    m = re.search(r"\$callback\(([^)]*)\)", core)
    args = [a.strip() for a in m.group(1).split(",")]
    def body(n):
        return re.sub(r"\$callback\(([^)]*)\)", lambda mm: "$callback(%s)" % ", ".join(args[:n]), core).strip("\n")
    out = ["$arity = self::callbackArity($callback);"]
    for max_arity, n, fast in tiers:
        out.append("if($arity <= %d){\n%s\n}" % (max_arity, indent(fast if fast else body(n), 4)))
    out.append(core.strip("\n"))
    return "\n".join(out)

def spec(trait, name, summary, link, sig=(), kind="A", expr=None, core=None, ret="", extra_doc="", tiers=None):
    if tiers:
        core = expand(core, tiers)
    M.setdefault(trait, []).append(dict(name=name, summary=summary, link=link, sig=list(sig), kind=kind,
                                        expr=expr, core=core, ret=ret, extra_doc=extra_doc))

def raw(trait, text):
    M.setdefault(trait, []).append(dict(raw=text))

CB = ("callable $callback", "$callback")
IT = ("iterable ...$iterables", "...$iterables")
VALS = ("...$values", "...$values")
EACH = "foreach($array as $key => $value){"

# ---------------------------------------------------------------- ConcatTrait
T = "ConcatTrait"
spec(T, "concat", "Merge one or more arrays", "c/concat", [VALS], expr="array_merge($a, ...self::mapToArray($values))")
spec(T, "concatSoft", "All similar to concat(), but not overwrite existing keys", "c/concat/soft", [VALS], core="""
foreach($values as $value){
    $array += (array) $value;
}
return $array;""")
spec(T, "merge", "Alias of concat()", "c/concat", [VALS], expr="array_merge($a, ...self::mapToArray($values))")
spec(T, "mergeSoft", "Alias of concatSoft()", "c/concat/soft", [VALS], core="return self::concatSoftFromAs($array, ...$values);")
spec(T, "replace", "Replaces elements from passed arrays into the first array", "c/replace", [IT],
     expr="array_replace_recursive($a, ...self::mapToArray($iterables))")
spec(T, "flat", "Returns a new array with all sub-array elements concatenated into it recursively up to the specified depth",
     "c/flat", [("int $dept = 1", "$dept")], core="""
if($dept <= 0){
    return $array;
}
$parts = [];
foreach($array as $value){
    $parts[] = is_array($value) ? self::flatFromAs($value, $dept - 1) : (array) $value;
}
return $parts ? array_merge(...$parts) : [];""")
spec(T, "flatMap", "Returns a new array formed by applying $callback function and then flattening the result by one level",
     "c/flat/map", [CB], core="""
$parts = [];
foreach($array as $key => $value){
    $parts[] = (array) $callback($value, $key, $array);
}
return $parts ? array_merge(...$parts) : [];""", tiers=[(1, 1, None), (2, 2, None)])

# ---------------------------------------------------------------- SetTrait
T = "SetTrait"
def setop(name, fn, summary, link):
    spec(T, name, summary, link, [IT], expr="$iterables ? %s($a, ...self::mapToArray($iterables)) : $a" % fn)
setop("diff", "array_diff", "Computes the difference of arrays", "c/diff")
setop("diffAssoc", "array_diff_assoc", "All similar to diff(), but this applies with additional index check", "c/diff/assoc")
setop("diffKey", "array_diff_key", "All similar to diff(), but this applies to keys", "c/diff/key")
setop("intersect", "array_intersect", "Computes the intersection of arrays", "c/intersect")
setop("intersectAssoc", "array_intersect_assoc", "All similar to intersect(), but this applies to both keys and values", "c/intersect/assoc")
setop("intersectKey", "array_intersect_key", "All similar to intersect(), but this applies to keys", "c/intersect/key")
spec(T, "unique", "Removes duplicate values from an array", "c/unique", [("int $sortFlags = SORT_STRING", "$sortFlags")],
     expr="array_unique($a, $sortFlags)")
spec(T, "countValues", "Counts all the values of an array", "c/count-values", expr="array_count_values($a)")

# ---------------------------------------------------------------- IterationTrait
T = "IterationTrait"
spec(T, "map", "Applies the callback to the values of the given arrays", "c/map", [CB], core="""
$result = [];
%s
    $result[$key] = $callback($value, $key, $array);
}
return $result;""" % EACH, tiers=[(1, 1, "return array_map($callback, $array);"), (2, 2, None)])
spec(T, "mapAssoc", "All similar to map(), but this applies to both keys and values", "c/map/assoc", [CB], core="""
$result = [];
%s
    [$newKey, $newValue] = $callback($value, $key, $array);
    $result[$newKey] = $newValue;
}
return $result;""" % EACH, tiers=[(1, 1, None), (2, 2, None)])
spec(T, "mapKey", "All similar to map(), but this applies to keys", "c/map/key", [CB], core="""
$result = [];
%s
    $result[$callback($value, $key, $array)] = $value;
}
return $result;""" % EACH, tiers=[(1, 1, None), (2, 2, None)])
spec(T, "filter", "Returns a new array with all elements that pass the $callback function", "c/filter", [CB], core="""
$result = [];
%s
    if($callback($value, $key, $array)){
        $result[$key] = $value;
    }
}
return $result;""" % EACH, tiers=[(1, 1, "return array_filter($array, $callback);"), (2, 2, "return array_filter($array, $callback, ARRAY_FILTER_USE_BOTH);")])
spec(T, "forEach", "Executes a $callback function once for each array element", "c/for-each", [CB], core="""
%s
    $callback($value, $key, $array);
}
return $array;""" % EACH, tiers=[(1, 1, None), (2, 2, None)])
spec(T, "every", "Tests whether all elements pass the $callback function", "g/every", [CB], kind="V", ret="bool", core="""
%s
    if(!$callback($value, $key, $array)){
        return false;
    }
}
return true;""" % EACH, tiers=[(1, 1, None), (2, 2, None)])
spec(T, "some", "Tests whether least one element pass the $callback function", "g/some", [CB], kind="V", ret="bool", core="""
%s
    if($callback($value, $key, $array)){
        return true;
    }
}
return false;""" % EACH, tiers=[(1, 1, None), (2, 2, None)])
spec(T, "reduce", "Executes a reducer function on each element of the array, resulting in single output value", "g/reduce",
     [CB, ("$initialValue = null", "$initialValue")], kind="V", core="""
$currentValue = $initialValue;
%s
    $currentValue = $callback($currentValue, $value, $key, $array);
}
return $currentValue;""" % EACH, tiers=[(2, 2, "return array_reduce($array, $callback, $initialValue);"), (3, 3, None)])
spec(T, "reduceRight", "All similar to reduce(), but reverse order", "g/reduce/right",
     [CB, ("$initialValue = null", "$initialValue")], kind="V", core="""
$currentValue = $initialValue;
foreach(array_reverse($array, true) as $key => $value){
    $currentValue = $callback($currentValue, $value, $key, $array);
}
return $currentValue;""", tiers=[(2, 2, "return array_reduce(array_reverse($array), $callback, $initialValue);"), (3, 3, None)])
spec(T, "sum", "Calculate the sum of values in an array", "g/sum", kind="V", ret="int|float", expr="array_sum($a)")

# ---------------------------------------------------------------- SearchTrait
T = "SearchTrait"
START = ("int $start = 0", "$start")
NEEDLE = ("$needle", "$needle")
CLAMP = """if($start !== 0){
    $count = count($array);
    $array = array_slice($array, $start < 0 ? max($count + $start, 0) : min($start, $count), null, true);
}"""
spec(T, "includes", "Tests whether an array includes a $needle", "g/includes", [NEEDLE, START], kind="V", ret="bool", core=CLAMP + """
return in_array($needle, $array, true);""")
spec(T, "indexOf", "Returns the first index at which a given element can be found in the array", "g/index-of",
     [NEEDLE, START], kind="V", ret="int|string|null", core=CLAMP + """
$key = array_search($needle, $array, true);
return $key === false ? null : $key;""")
spec(T, "search", "Alias of indexOf()", "g/index-of", [NEEDLE, START], kind="V", ret="int|string|null",
     core="return self::indexOfFrom($array, $needle, $start);")
spec(T, "keyExists", "Tests whether the $key exists in the array", "g/key-exists", [("$key", "$key")],
     kind="V", ret="bool", core="return array_key_exists($key, $array);")
spec(T, "find", "Returns the value of the first element that that pass the $callback function", "g/find", [CB], kind="V", core="""
%s
    if($callback($value, $key, $array)){
        return $value;
    }
}
return null;""" % EACH, tiers=[(1, 1, None), (2, 2, None)])
spec(T, "findIndex", "Returns the key of the first element that that pass the $callback function", "g/find/index", [CB],
     kind="V", ret="int|string|null", core="""
%s
    if($callback($value, $key, $array)){
        return $key;
    }
}
return null;""" % EACH, tiers=[(1, 1, None), (2, 2, None)])
spec(T, "first", "Returns the first value of an array, or null if it is empty", "g/first", kind="V", core="""
foreach($array as $value){
    return $value;
}
return null;""")
spec(T, "keyFirst", "Gets the first key of an array", "g/first/key", kind="V", ret="int|string|null", core="""
foreach($array as $key => $_){
    return $key;
}
return null;""")
spec(T, "last", "Returns the last value of an array, or null if it is empty", "g/last", kind="V", core="""
if(\\PHP_VERSION_ID >= 70300){
    $key = array_key_last($array);
    return $key === null ? null : $array[$key];
}
return $array ? end($array) : null;""")
spec(T, "keyLast", "Gets the last key of an array", "g/last/key", kind="V", ret="int|string|null", core="""
if(\\PHP_VERSION_ID >= 70300){
    return array_key_last($array);
}
if(!$array){
    return null;
}
end($array);
return key($array);""")
spec(T, "random", "Returns the random value of an array, or null if it is empty", "g/random", kind="V", core="""
$count = count($array);
if($count === 0){
    return null;
}
try{
    $index = random_int(0, $count - 1);
}catch(Exception $_){
    return null;
}
return array_values($array)[$index];""")
spec(T, "keyRandom", "Gets the random key of an array", "g/random/key", kind="V", ret="int|string|null", core="""
$count = count($array);
if($count === 0){
    return null;
}
try{
    $index = random_int(0, $count - 1);
}catch(Exception $_){
    return null;
}
return array_keys($array)[$index];""")

# ---------------------------------------------------------------- SortTrait
T = "SortTrait"
spec(T, "sort", "Sort an array by values using a $callback function or default sort function\n     * If $callback is null, run sort(), else run usort()",
     "c/sort", [("?callable $callback = null", "$callback")], core="""
if($callback === null){
    sort($array);
}else{
    usort($array, $callback);
}
return $array;""")
spec(T, "sortKey", "Sort an array by keys using a $callback function or default sort function\n     * If $callback is null, run ksort(), else run uksort()",
     "c/sort/key", [("?callable $callback = null", "$callback")], core="""
if($callback === null){
    ksort($array);
}else{
    uksort($array, $callback);
}
return $array;""")
spec(T, "reverse", "Returns an array with elements in reverse order", "c/reverse", [("bool $preserveKeys = false", "$preserveKeys")],
     expr="array_reverse($a, $preserveKeys)")

# ---------------------------------------------------------------- StackTrait
T = "StackTrait"
spec(T, "push", "Push elements onto the end of array", "c/push", [VALS], core="""
if($values){
    array_push($array, ...$values);
}
return $array;""")
spec(T, "unshift", "Push elements onto the start of array", "c/unshift", [VALS], core="""
if($values){
    array_unshift($array, ...$values);
    return $array;
}

//Without values, array_unshift() only renumbers the integer keys (calling it without values is invalid before PHP 7.3)
$result = [];
foreach($array as $key => $value){
    if(is_int($key)){
        $result[] = $value;
    }else{
        $result[$key] = $value;
    }
}
return $result;""")
raw(T, '''    /**
     * Removes the last element and returns that element
     *
     * @link https://arrayutils.docs.present.kim/methods/g/pop
     */
    public function pop(){
        $array = $this->getArrayCopy();
        $value = array_pop($array);
        $this->exchangeArray($array);
        return $value;
    }

    /**
     * Same as pop(), but operates on a copy of the given iterable (the given iterable is not modified)
     *
     * @link https://arrayutils.docs.present.kim/methods/g/pop
     */
    public static function popFrom(iterable $from){
        $array = is_array($from) ? $from : self::toArray($from);
        return array_pop($array);
    }

    /**
     * Removes the first element and returns that element
     *
     * @link https://arrayutils.docs.present.kim/methods/g/shift
     */
    public function shift(){
        $array = $this->getArrayCopy();
        $value = array_shift($array);
        $this->exchangeArray($array);
        return $value;
    }

    /**
     * Same as shift(), but operates on a copy of the given iterable (the given iterable is not modified)
     *
     * @link https://arrayutils.docs.present.kim/methods/g/shift
     */
    public static function shiftFrom(iterable $from){
        $array = is_array($from) ? $from : self::toArray($from);
        return array_shift($array);
    }

    /**
     * Remove a portion of the array and replace it with something else
     * If $length is null, removes everything from $offset to the end
     *
     * @return array The removed elements
     * @link https://arrayutils.docs.present.kim/methods/g/splice
     */
    public function splice(int $offset, ?int $length = null, ...$replacement) : array{
        $array = $this->getArrayCopy();
        $removed = array_splice($array, $offset, $length ?? count($array), $replacement);
        $this->exchangeArray($array);
        return $removed;
    }

    /**
     * Same as splice(), but operates on a copy of the given iterable (the given iterable is not modified)
     *
     * @return array The removed elements
     * @link https://arrayutils.docs.present.kim/methods/g/splice
     */
    public static function spliceFrom(iterable $from, int $offset, ?int $length = null, ...$replacement) : array{
        $array = is_array($from) ? $from : self::toArray($from);
        return array_splice($array, $offset, $length ?? count($array), $replacement);
    }
''')

# ---------------------------------------------------------------- ShapeTrait
T = "ShapeTrait"
spec(T, "chunk", "Split an array into chunks", "c/chunk", [("int $size", "$size"), ("bool $preserveKeys = false", "$preserveKeys")],
     expr="array_chunk($a, $size, $preserveKeys)")
spec(T, "column", "Returns the values from a single column in the input array", "c/column",
     [("$valueKey", "$valueKey"), ("$indexKey = null", "$indexKey")], expr="array_column($a, $valueKey, $indexKey)")
spec(T, "combine", "Creates an array by using one array for keys and another for its values\n     * If $valueArray is null, uses the array itself",
     "c/combine", [("?iterable $valueArray = null", "$valueArray")], expr="array_combine($a, (array) ($valueArray ?? $a))")
spec(T, "fill", "Changes all elements in an array to a provided value, from a start index to an end index", "c/fill",
     [("$value", "$value"), ("int $start = 0", "$start"), ("?int $end = null", "$end")], core="""
$keys = array_keys($array);
[$i, $max] = self::resolveRange(count($keys), $start, $end ?? PHP_INT_MAX);
for(; $i < $max; ++$i){
    $array[$keys[$i]] = $value;
}
return $array;""")
spec(T, "fillKeys", "Fill an array with values, specifying keys", "c/fill/keys", [("$value", "$value")],
     expr="array_fill_keys($a, $value)")
spec(T, "flip", "Exchanges all keys with their associated values in an array", "c/flip", expr="array_flip($a)")
spec(T, "keys", "Returns all the keys of an array", "c/keys", expr="array_keys($a)")
spec(T, "values", "Returns all the values of an array", "c/values", expr="array_values($a)")
spec(T, "pad", "Pad array to the specified length with a value", "c/pad", [("int $size", "$size"), ("$value", "$value")],
     expr="array_pad($a, $size, $value)")
spec(T, "slice", "Returns an array with selected from start to end\n     * Extract a slice of the array", "c/slice",
     [("int $start = 0", "$start"), ("?int $end = null", "$end"), ("bool $preserveKeys = false", "$preserveKeys")], core="""
[$i, $max] = self::resolveRange(count($array), $start, $end ?? PHP_INT_MAX);
if($max <= $i){
    return [];
}
$result = array_slice($array, $i, $max - $i, true);
return $preserveKeys ? $result : array_values($result);""")
spec(T, "join", "Join array elements with a string. You can specify a suffix and prefix", "g/join",
     [('string $glue = ","', "$glue"), ('string $prefix = ""', "$prefix"), ('string $suffix = ""', "$suffix")],
     kind="V", ret="string", expr="$prefix . implode($glue, $a) . $suffix")
raw(T, '''    /**
     * Converts the $start and $end indexes (negative values count from the end) to an offset range of $count elements
     *
     * @return int[] [first index, last index + 1]
     */
    private static function resolveRange(int $count, int $start, int $end) : array{
        return [
            $start < 0 ? max($count + $start, 0) : min($start, $count),
            $end < 0 ? max($count + $end, 0) : min($end, $count)
        ];
    }
''')

# ---------------------------------------------------------------- rendering
def sigdecl(sig): return ", ".join(d for d, _ in sig)
def sigcall(sig): return ", ".join(c for _, c in sig)

def render_expr(expr, source):
    """returns (prefix statements, return expression)"""
    if len(re.findall(r"\$a\b", expr)) > 1:
        return "$a = %s;\n" % source, expr
    return "", re.sub(r"\$a\b", lambda m: source, expr)

def method(fn_name, decl, ret, body, doc, static=False):
    r = (" : " + ret) if ret else ""
    s = "static " if static else ""
    return "    /**\n     * %s\n     */\n    public %sfunction %s(%s)%s{\n%s\n    }\n" % (doc, s, fn_name, decl, r, indent(body, 8))

def gen(m):
    n, sig, kind = m["name"], m["sig"], m["kind"]
    decl, call = sigdecl(sig), sigcall(sig)
    fdecl = "iterable $from" + (", " + decl if decl else "")
    link = "\n     *\n     * @link " + DOC + m["link"]
    out = []
    if kind == "A":
        if m["expr"]:
            p1, e1 = render_expr(m["expr"], "$this->getArrayCopy()")
            p2, e2 = render_expr(m["expr"], "(is_array($from) ? $from : self::toArray($from))")
            b_inst = p1 + "$this->exchangeArray(%s);\nreturn $this;" % e1
            b_as = p1 + "return %s;" % e1
            b_fromas = p2 + "return %s;" % e2
            b_from = p2 + "$utils = self::blank();\n$utils->exchangeArray(%s);\nreturn $utils;" % e2
        else:
            c = "self::%sFromAs($this->getArrayCopy(), %s)" % (n, call) if call else "self::%sFromAs($this->getArrayCopy())" % n
            b_inst = "$this->exchangeArray(%s);\nreturn $this;" % c
            b_as = "return %s;" % c
            cf = "self::%sFromAs($from, %s)" % (n, call) if call else "self::%sFromAs($from)" % n
            b_from = "$utils = self::blank();\n$utils->exchangeArray(%s);\nreturn $utils;" % cf
            b_fromas = "$array = is_array($from) ? $from : self::toArray($from);\n" + m["core"].strip("\n")
        out.append(method(n, decl, "ArrayUtils", b_inst, m["summary"] + link))
        out.append(method(n + "As", decl, "array", b_as, "Same as %s(), but returns a plain array and leaves the instance unchanged" % n))
        out.append(method(n + "From", fdecl, "ArrayUtils", b_from, "Same as %s(), but operates on the given iterable and returns a new ArrayUtils" % n, True))
        out.append(method(n + "FromAs", fdecl, "array", b_fromas, "Same as %sFrom(), but returns a plain array" % n, True))
    else:
        ret = m["ret"]
        phpret = ret if ret in ("bool", "string") else ""
        doc_ret = "" if phpret or not ret else "\n     *\n     * @return " + ret
        if m["expr"]:
            p1, e1 = render_expr(m["expr"], "$this->getArrayCopy()")
            p2, e2 = render_expr(m["expr"], "(is_array($from) ? $from : self::toArray($from))")
            b_inst = p1 + "return %s;" % e1
            b_from = p2 + "return %s;" % e2
        else:
            cf = "self::%sFrom($this->getArrayCopy(), %s)" % (n, call) if call else "self::%sFrom($this->getArrayCopy())" % n
            b_inst = "return %s;" % cf
            b_from = "$array = is_array($from) ? $from : self::toArray($from);\n" + m["core"].strip("\n")
        out.append(method(n, decl, phpret, b_inst, m["summary"] + doc_ret + link))
        out.append(method(n + "From", fdecl, phpret, b_from, "Same as %s(), but operates on the given iterable" % n + doc_ret, True))
    return "\n".join(out)

DESC = {
    "ConcatTrait": "Methods that join arrays together (concat, merge, replace, flat)",
    "SetTrait": "Methods that compare arrays or collapse duplicates (diff, intersect, unique, countValues)",
    "IterationTrait": "Methods that walk every element with a callback (map, filter, forEach, reduce, every, some)",
    "SearchTrait": "Methods that look up a single element or key (includes, indexOf, find, first, last, random)",
    "SortTrait": "Methods that reorder the elements (sort, sortKey, reverse)",
    "StackTrait": "Methods that add or remove elements at a position (push, pop, shift, unshift, splice)",
    "ShapeTrait": "Methods that change the shape of the array (chunk, column, combine, fill, flip, keys, values, pad, slice, join)",
}
GENERATED = " * @generated by tools/generate-traits.py - do not edit by hand, edit the spec in that script instead"

outputs = {}
for trait, items in M.items():
    body = "\n".join(it["raw"] if "raw" in it else gen(it) for it in items)
    funcs = sorted(f for f in FUNCS if re.search(r"(?<![\w>:$])%s\(" % f, body))
    uses = ["use kim\\present\\lib\\arrayutils\\ArrayUtils;"] + (["use Exception;"] if "Exception" in body else [])
    uses += ["use const ARRAY_FILTER_USE_BOTH;"] if "ARRAY_FILTER_USE_BOTH" in body else []
    uses += ["use function %s;" % f for f in funcs]
    text = HEADER.rstrip("\n") + "\n * @noinspection PhpUnused\n * @noinspection PhpDocSignatureIsNotCompleteInspection\n" + GENERATED + "\n */\n\ndeclare(strict_types=1);\n\nnamespace kim\\present\\lib\\arrayutils\\traits;\n\n"
    text += "\n".join(uses) + ("\n\n" if uses else "")
    text += "/**\n * %s\n *\n * Requires ArrayUtils::toArray(), ArrayUtils::mapToArray(), ArrayUtils::blank() and ArrayUtils::callbackArity() of the class using this trait\n */\ntrait %s{\n" % (DESC[trait], trait)
    text += body.rstrip("\n") + "\n}\n"
    outputs[os.path.join(OUT, trait + ".php")] = text

if "--check" in sys.argv:
    stale = []
    for path, text in outputs.items():
        try:
            with open(path, encoding="utf-8", newline="") as f:
                current = f.read()
        except FileNotFoundError:
            current = None
        if current != text:
            stale.append(os.path.relpath(path, ROOT))
    if stale:
        print("Out of date, run `python3 tools/generate-traits.py`:\n  " + "\n  ".join(stale))
        sys.exit(1)
    print("Traits are up to date")
else:
    os.makedirs(OUT, exist_ok=True)
    for path, text in outputs.items():
        with open(path, "w", encoding="utf-8", newline="") as f:
            f.write(text)
    print("Generated %d traits" % len(outputs))
