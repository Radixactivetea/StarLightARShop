<?php


namespace Core;

class FormValidator
{
    private $errors = [];
    private $data = [];
    private $sanitizedData = [];

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->sanitizedData = $this->sanitizeAll($data);
    }

    /**
     * Sanitize all input data to prevent HTML injection
     * 
     * @param array $data Input data to sanitize
     * @return array Sanitized data
     */
    private function sanitizeAll(array $data): array
    {
        $sanitized = [];
        foreach ($data as $key => $value) {
            $sanitized[$key] = is_array($value)
                ? $this->sanitizeAll($value)
                : $this->sanitize($value);
        }
        return $sanitized;
    }

    /**
     * Sanitize a single input value
     * 
     * @param mixed $value Value to sanitize
     * @return string Sanitized value
     */
    public function sanitize($value): string
    {
        // Convert to string
        $value = (string) $value;

        // Remove control characters
        $value = preg_replace('/[\x00-\x1F\x7F]/', '', $value);

        // Use htmlspecialchars for HTML encoding
        return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Get sanitized data
     * 
     * @return array Sanitized input data
     */
    public function getSanitizedData(): array
    {
        return $this->sanitizedData;
    }

    /**
     * Get a specific sanitized value
     * 
     * @param string $field Field name
     * @return string|null Sanitized value
     */
    public function getSanitizedValue(string $field): ?string
    {
        return $this->sanitizedData[$field] ?? null;
    }

    // ... (previous validation methods remain the same)

    public function required(string $field, string $fieldName = null)
    {
        $fieldName ??= $field;

        if (!isset($this->data[$field]) || trim($this->data[$field]) === '') {
            $this->errors[$field] = ucfirst($fieldName) . " is required.";
        }

        return $this;
    }

    public function requiredCheckbox(string $field, string $fieldName = null, int $minChecked = 1) {
        $fieldName ??= $field;
        
        // Assume checkboxes are sent as an array
        if (!isset($this->data[$field]) || 
            !is_array($this->data[$field]) || 
            count($this->data[$field]) < $minChecked) {
            $this->errors[$field] = "Please select at least $minChecked option(s) for $fieldName.";
        }
        
        return $this;
    }

    public function email(string $field, string $fieldName = null)
    {
        $fieldName ??= $field;

        if (isset($this->data[$field]) && !filter_var($this->data[$field], FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = ucfirst($fieldName) . " must be a valid email address.";
        }

        return $this;
    }

    public function minLength(string $field, int $length, string $fieldName = null)
    {
        $fieldName ??= $field;

        if (isset($this->data[$field]) && strlen(trim($this->data[$field])) < $length) {
            $this->errors[$field] = ucfirst($fieldName) . " must be at least $length characters long.";
        }

        return $this;
    }

    public function maxLength(string $field, int $length, string $fieldName = null)
    {
        $fieldName ??= $field;

        if (isset($this->data[$field]) && strlen(trim($this->data[$field])) > $length) {
            $this->errors[$field] = ucfirst($fieldName) . " must not exceed $length characters.";
        }

        return $this;
    }

    public function numeric(string $field, string $fieldName = null)
    {
        $fieldName ??= $field;

        if (isset($this->data[$field]) && !is_numeric($this->data[$field])) {
            $this->errors[$field] = ucfirst($fieldName) . " must be a number.";
        }

        return $this;
    }

    public function match(string $field, string $matchField, string $fieldName = null)
    {
        $fieldName ??= $field;

        if (
            isset($this->data[$field], $this->data[$matchField]) &&
            $this->data[$field] !== $this->data[$matchField]
        ) {
            $this->errors[$field] = ucfirst($fieldName) . " does not match.";
        }

        return $this;
    }

    public function passes(): bool
    {
        return count($this->errors) === 0;
    }

    public function fails(): bool
    {
        return count($this->errors) > 0;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getError(string $field): ?string
    {
        return $this->errors[$field] ?? null;
    }
}