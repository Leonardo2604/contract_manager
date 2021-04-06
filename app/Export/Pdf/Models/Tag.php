<?php

namespace App\Export\Pdf\Models;

abstract class Tag
{
    private $tag;
    private $content;
    private $properties;

    public function __construct(string $tag, $content = '')
    {
        $this->tag = $tag;
        $this->content = $content;
        $this->properties = [];
    }

    public function addProperty(string $name, string $value): void
    {
        $this->properties[$name] = $value;
    }

    public function addContent($value)
    {
        if (!is_array($this->content)) {
            $this->content = [$this->content];
        }

        $this->content[] = $value;
    }

    public function toHtml(): string
    {
        $properties = trim($this->propertiesToString());

        if (!empty($properties)) {
            return "<{$this->tag} {$this->propertiesToString()}>{$this->contentToString()}</{$this->tag}>";
        }

        return "<{$this->tag}>{$this->contentToString()}</{$this->tag}>";
    }

    public function __toString()
    {
        return $this->toHtml();
    }

    private function propertiesToString(): string
    {
        $props = [];
        foreach ($this->properties as $name => $value) {
            $props[] = "$name=\"$value\"";
        }

        return implode(' ', $props);
    }

    private function contentToString(): string
    {
        if (is_string($this->content)) {
            return $this->content;
        }

        if (is_array($this->content)) {
            return implode('', array_map(function($tag) {
                return (string) $tag;
            }, $this->content));
        }
    }
}
