<?php

class Validator
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
            // explode rules into array
            $rules = explode('|', $rule['rules']);

            if(in_array('nullable', $rules) && empty($this->data[$field])) {
                $this->data[$field] = null;
                continue;
            }

            // check each rule
            foreach ($rules as $rule) {
                $rule = trim($rule);

                // check if rule has parameter
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

    private function nullable($field)
    {
        if (empty($this->data[$field])) {
            $this->data[$field] = null;
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

    private function numeric($field)
    {
        if (!is_numeric($this->data[$field])) {
            $this->errors[$field] = $this->rules[$field]['label'] . ' harus berupa angka';
        }
    }

    private function min($field, $min)
    {
        if ($this->data[$field] < $min) {
            $this->errors[$field] = $this->rules[$field]['label'] . ' minimal ' . $min;
        }
    }

    private function max($field, $max)
    {
        if ($this->data[$field] > $max) {
            $this->errors[$field] = $this->rules[$field]['label'] . ' maksimal ' . $max;
        }
    }

    private function user_unique($field, $id = null)
    {
        $this->CI->load->model('User', 'user');
        $user = $this->CI->user->getFiltered(['username' => $this->data[$field]])->row();
        if ($user && $user->id != $id) {
            $this->errors[$field] = $this->rules[$field]['label'] . ' sudah digunakan';
        }
    }

    private function is_date($field)
    {
        if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $this->data[$field])) {
            $this->errors[$field] = $this->rules[$field]['label'] . ' tidak valid';
        }
    }

    private function is_time($field)
    {
        if (!preg_match('/^[0-9]{2}:[0-9]{2}:[0-9]{2}$/', $this->data[$field])) {
            $this->errors[$field] = $this->rules[$field]['label'] . ' tidak valid';
        }
    }

    private function is_datetime($field)
    {
        if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$/', $this->data[$field])) {
            $this->errors[$field] = $this->rules[$field]['label'] . ' tidak valid';
        }
    }
}