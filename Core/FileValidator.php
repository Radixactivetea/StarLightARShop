<?php


namespace Core;

class FileValidator
{
    private $errors = [];
    private $file = [];

    /**
     * Constructor to set file data
     * 
     * @param array $file File upload data ($_FILES['fieldname'])
     */
    public function __construct(array $file)
    {
        $this->file = $file;
    }

    /**
     * Check if file is required
     * 
     * @param string $fieldName Field name in $_FILES
     * @return $this
     */
    public function required()
    {
        if (empty($this->file['name'])) {
            $this->errors['file'] = "File is required.";
        }
        return $this;
    }

    /**
     * Validate file size
     * 
     * @param int $maxSizeInMB Maximum file size in megabytes
     * @return $this
     */
    public function maxSize(int $maxSizeInMB)
    {
        $maxBytes = $maxSizeInMB * 1024 * 1024;

        if ($this->file['size'] > $maxBytes) {
            $this->errors['size'] = "File must be less than {$maxSizeInMB} MB.";
        }
        return $this;
    }

    /**
     * Validate file type
     * 
     * @param array $allowedTypes Allowed file types (e.g., ['jpg', 'png', 'gif'])
     * @return $this
     */
    public function allowedTypes(array $allowedTypes)
    {
        // Normalize allowed types to lowercase
        $allowedTypes = array_map('strtolower', $allowedTypes);

        // Get file extension
        $fileExt = strtolower(pathinfo($this->file['name'], PATHINFO_EXTENSION));

        if (!in_array($fileExt, $allowedTypes)) {
            $this->errors['type'] = "Allowed file types are: " . implode(', ', $allowedTypes);
        }
        return $this;
    }

    /**
     * Validate image dimensions
     * 
     * @param int|null $maxWidth Maximum image width
     * @param int|null $maxHeight Maximum image height
     * @return $this
     */
    public function maxDimensions(?int $maxWidth = null, ?int $maxHeight = null)
    {
        // Only validate for image files
        if (strpos($this->file['type'], 'image/') === 0) {
            // Get image dimensions
            $imageDimensions = getimagesize($this->file['tmp_name']);

            if ($imageDimensions === false) {
                $this->errors['image'] = "Invalid image file.";
                return $this;
            }

            $width = $imageDimensions[0];
            $height = $imageDimensions[1];

            if (
                ($maxWidth && $width > $maxWidth) ||
                ($maxHeight && $height > $maxHeight)
            ) {
                $this->errors['dimensions'] = "Image exceeds maximum dimensions. " .
                    ($maxWidth ? "Max width: {$maxWidth}px. " : "") .
                    ($maxHeight ? "Max height: {$maxHeight}px." : "");
            }
        }
        return $this;
    }

    public function isEmpty(): bool
    {
        return empty($this->file) || $this->file['size'] === 0;
    }

    /**
     * Move uploaded file to destination
     * 
     * @param string $destination Destination path
     * @param string|null $newFileName Optional new filename
     * @return string|false Path of moved file or false on failure
     */
    public function move(string $destination, ?string $newFileName = null)
    {
        // Ensure no validation errors
        if (!empty($this->errors)) {
            return false;
        }

        // Create destination directory if it doesn't exist
        if (!is_dir(dirname($destination))) {
            mkdir(dirname($destination), 0777, true);
        }

        // Generate filename if not provided
        if ($newFileName === null) {
            $newFileName = uniqid() . '.' . pathinfo($this->file['name'], PATHINFO_EXTENSION);
        }

        $finalDestination = rtrim($destination, '/') . '/' . $newFileName;

        // Move uploaded file
        if (move_uploaded_file($this->file['tmp_name'], $finalDestination)) {
            return $newFileName;
        }

        $this->errors['move'] = "Failed to move uploaded file.";
        return false;
    }

    /**
     * Check if validation passed
     * 
     * @return bool
     */
    public function passes(): bool
    {
        return empty($this->errors);
    }

    /**
     * Check if validation failed
     * 
     * @return bool
     */
    public function fails(): bool
    {
        return !empty($this->errors);
    }

    /**
     * Get all validation errors
     * 
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}