<?php

class Html {
    
    /**
     * Generate HTML tag
     * @param string $tag HTML tag
     * @param string $content HTML content
     * @param array $attributes HTML attributes
     * @return string HTML tag
     */
    public function generate($tag, $content = '', $attributes = array()) {
        $html = '<' . $tag;
        foreach ($attributes as $key => $value) {
            $html .= ' ' . $key . '="' . $value . '"';
        }
        $html .= '>';
        $html .= $content;
        $html .= '</' . $tag . '>';
        return $html;
    }
}