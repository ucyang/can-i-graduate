// 본 소스 파일은 삭제 및 타 파일로의 병합이 예정되어 있습니다.
// 추후에 error message 관리를 위해 포함할 예정입니다.

<?php
/*
	7.6
	
	- 기본값을 포함한 폼 출력
	- 제출 데이터 검증
	- 폼 재출력 시 오류 메시지 표시, 제출 데이터가 올바르지 않을 때 사용자 입력 보존
	- 제출 데이터에 이상이 없으면 폼 처리 과정 수행
*/

class former {
	protected $values = array();
	public function __construct($values = array()) {
    	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->values = $_POST;
        } else {
            $this->values = $values;
        }
    }
    public function input($type, $attributes = array(), $isMultiple = false) {
        $attributes['type'] = $type;
        if (($type == 'radio') || ($type == 'checkbox')) {
            if ($this->isOptionSelected($attributes['name'] ?? null,
                                        $attributes['value'] ?? null)) {
                $attributes['checked'] = true;
        	}
        }
        return $this->tag('input', $attributes, $isMultiple);
    }
    public function select($options, $attributes = array()) {
        $multiple = $attributes['multiple'] ?? false;
        return
            $this->start('select', $attributes, $multiple) .
            $this->options($attributes['name'] ?? null, $options) .
            $this->end('select');
    }
    public function textarea($attributes = array()) {
        $name = $attributes['name'] ?? null;
        $value = $this->values[$name] ?? '';
        return $this->start('textarea', $attributes) .
               htmlentities($value) .
               $this->end('textarea');
    }
    public function tag($tag, $attributes = array(), $isMultiple = false) {
        return "<$tag {$this->attributes($attributes, $isMultiple)} />";
    }
    public function start($tag, $attributes = array(), $isMultiple = false) {
        // <select> and <textarea> tags don't get value attributes on them
        $valueAttribute = (! (($tag == 'select')||($tag == 'textarea')));
        $attrs = $this->attributes($attributes, $isMultiple, $valueAttribute);
        return "<$tag $attrs>";
    }
    public function end($tag) {
        return "</$tag>";
    }
    protected function attributes($attributes, $isMultiple,
                                  $valueAttribute = true) {
        $tmp = array();
        // If this tag could include a value attribute and it
        // has a name and there's an entry for the name
        // in the values array, then set a value attribute
        if ($valueAttribute && isset($attributes['name']) &&
            array_key_exists($attributes['name'], $this->values)) {
            $attributes['value'] = $this->values[$attributes['name']];
        }
        foreach ($attributes as $k => $v) {
            // True boolean value means boolean attribute
            if (is_bool($v)) {
                if ($v) { $tmp[] = $this->encode($k); }
            }
            // Otherwise k=v
            else {
                $value = $this->encode($v);
                // If this is an element that might have multiple values,
                // tack [] onto its name
                if ($isMultiple && ($k == 'name')) {
                    $value .= '[]';
                }
                $tmp[] = "$k=\"$value\"";
            }
        }
        return implode(' ', $tmp);
    }
    protected function options($name, $options) {
        $tmp = array();
        foreach ($options as $k => $v) {
            $s = "<option  value=\"{$this->encode($k)}\"";
            if ($this->isOptionSelected($name, $k)) {
                $s .= ' selected';
            }
            $s .= ">{$this->encode($v)}</option>";
            $tmp[] = $s;
        }
        return implode('', $tmp);
    }
    protected function isOptionSelected($name, $value) {
        // If there's no entry for $name in the values array,
        // then this option can't be selected
        if (! isset($this->values[$name])) {
            return false;
        }
        // If the entry for $name in the values array is itself
        // an array, check if $value is in that array
        else if (is_array($this->values[$name])) {
            return in_array($value, $this->values[$name]);
        }
        // Otherwise, compare $value to the entry to for $name
        // in the values array
        else {
            return $value == $this->values[$name];
        }
    }
    public function encode($s) {
        return htmlentities($s);
    }
}

?>
