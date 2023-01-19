<?php

class FormValidator
{
    private $CI;
    private $rules = [];
    private $errors = [];
    private $data = [];

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function set_rules($field, $label, $rules)
    {
        $this->rules[$field] = [
            'label' => $label,
            'rules' => $rules
        ];
    }

    public function run()
    {
        $this->data = $this->CI->input->post();
        foreach ($this->rules as $field => $rule) {
            $rules = explode('|', $rule['rules']);
            foreach ($rules as $rule) {
                $rule = trim($rule);
                if (strpos($rule, '[') !== false) {
                    $rule = explode('[', $rule);
                    $rule[1] = str_replace(']', '', $rule[1]);
                    $this->{$rule[0]}($field, $rule[1]);
                } else {
                    $this->{$rule}($field);
                }
            }
        }
        return count($this->errors) == 0;
    }

    public function get_errors()
    {
        return $this->errors;
    }

    public function get_data()
    {
        return $this->data;
    }

    private function required($field)
    {
        if (empty($this->data[$field])) {
            $this->errors[$field] = $this->rules[$field]['label'] . ' tidak boleh kosong';
        }
    }

    private function min_length($field, $length)
    {
        if (strlen($this->data[$field]) < $length) {
            $this->errors[$field] = $this->rules[$field]['label'] . ' minimal ' . $length . ' karakter';
        }
    }

    private function max_length($field, $length)
    {
        if (strlen($this->data[$field]) > $length) {
            $this->errors[$field] = $this->rules[$field]['label'] . ' maksimal ' . $length . ' karakter';
        }
    }

    private function matches($field, $match)
    {
        if ($this->data[$field] != $this->data[$match]) {
            $this->errors[$field] = $this->rules
                [$field]['label'] . ' tidak sama dengan ' . $this->rules[$match]['label'];
        }
    }

    private function is_unique($field)
    {
        $this->CI->db->where($field, $this->data[$field]);
        $query = $this->CI->db->get($this->rules[$field]['table']);
        if ($query->num_rows() > 0) {
            $this->errors[$field] = $this->rules[$field]['label'] . ' sudah terdaftar';
        }
    }

    private function is_valid_email($field)
    {
        if (!filter_var($this->data[$field], FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = $this->rules[$field]['label'] . ' tidak valid';
        }
    }

    private function is_valid_phone($field)
    {
        if (!preg_match('/^[0-9]{10,13}$/', $this->data[$field])) {
            $this->errors[$field] = $this->rules[$field]['label'] . ' tidak valid';
        }
    }

    private function is_valid_date($field)
    {
        if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $this->data[$field])) {
            $this->errors[$field] = $this->rules[$field]['label'] . ' tidak valid';
        }
    }

    private function is_valid_time($field)
    {
        if (!preg_match('/^[0-9]{2}:[0-9]{2}:[0-9]{2}$/', $this->data[$field])) {
            $this->errors[$field] = $this->rules[$field]['label'] . ' tidak valid';
        }
    }

    private function is_valid_datetime($field)
    {
        if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$/', $this->data[$field])) {
            $this->errors[$field] = $this->rules[$field]['label'] . ' tidak valid';
        }
    }

    private function is_valid_url($field)
    {
        if (!filter_var($this->data[$field], FILTER_VALIDATE_URL)) {
            $this->errors[$field] = $this->rules[$field]['label'] . ' tidak valid';
        }
    }
}