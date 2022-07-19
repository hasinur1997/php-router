<?php
namespace Hasinur\Xspeed\Traits;

/**
 * Validator traits
 */
trait Validator {
    /**
     * Store all errors
     *
     * @var array
     */
    protected $errors = [];

    /**
     * Input field
     *
     * @var array
     */
    protected $items;

    /**
     * Validations rules
     *
     * @var array
     */
    protected $rules = ['required', 'maxlength', 'minlength', 'email', 'alnum', 'match', 'alpha', 'number', 'maxword'];

    /**
     * Validation messags
     *
     * @var array
     */
    public $messages = [
        'required'  => '<i class="fa fa-exclamation"></i> :field  is required',
        'minlength' => '<i class="fa fa-exclamation"></i> :field  is minimum :satisifer character',
        'maxlength' => '<i class="fa fa-exclamation"></i> :field  is maximum :satisifer character',
        'email'     => '<i class="fa fa-exclamation"></i>Invalid email address',
        'alnum'     => '<i class="fa fa-exclamation"></i> :field must be alfanumeric',
        'match'     => '<i class="fa fa-exclamation"></i> :field must be matched :satisifer',
        'alpha'     => '<i class="fa fa-exclamation"></i> :field must be only characters',
        'number'     => '<i class="fa fa-exclamation"></i> :field must be only gigits',
        'maxword'     => '<i class="fa fa-exclamation"></i> :field is maximum of :satisifer words',
    ];

    /**
     * Check input field for validation
     *
     * @param array $items
     * @param array $rules
     *
     * @return Object
     */
    public function check( $items, $rules ) {$this->items = $items;
        foreach ( $items as $item => $value ) {

            if ( in_array( $item, array_keys( $rules ) ) ) {
                $this->validate( [
                    'field' => $item,
                    'value' => $value,
                    'rules' => $rules[$item],
                ] );
            }
        }

        return $this;
    }

    /**
     * Get all errors
     *
     * @return array
     */
    public function errors() {
        return $this->errorHandaler;
    }

    /**
     * Check fail or not
     *
     * @return boolean
     */
    public function fails() {
        return $this->hasError();
    }

    /**
     * Validate input fields
     *
     * @param [type] $item
     * @return void
     */
    protected function validate( $item ) {
        $field = $item['field'];
        foreach ( $item['rules'] as $rule => $satisifer ) {
            if ( in_array( $rule, $this->rules ) ) {
                if ( !call_user_func_array( [$this, $rule], [$field, $item['value'], $satisifer] ) ) {
                    $this->addError(
                        str_replace( [':field', ':satisifer'], [$field, $satisifer], $this->messages[$rule] ),
                        $field
                    );
                }
            }
        }
    }

    /**
     * Requied field validation
     *
     * @param [type] $field
     * @param [type] $value
     * @param [type] $satisifer
     * @return void
     */
    protected function required( $field, $value, $satisifer ) {
        return !empty( trim( $value ) );
    }

    /**
     * Ccheck max length
     *
     * @param [type] $field
     * @param [type] $value
     * @param [type] $satisifer
     * @return void
     */
    protected function maxlength( $field, $value, $satisifer ) {
        return mb_strlen( $value ) <= $satisifer;
    }

    /**
     * Check minlength
     *
     * @param [type] $field
     * @param [type] $value
     * @param [type] $satisifer
     * @return void
     */
    protected function minlength( $field, $value, $satisifer ) {
        return mb_strlen( $value ) >= $satisifer;
    }

    /**
     * Check word count
     *
     * @param [type] $field
     * @param [type] $value
     * @param [type] $satisifer
     * @return void
     */
    protected function maxword($field, $value, $satisifer) {
        return str_word_count($value) <= $satisifer;
    }

    /**
     * Check email
     *
     * @param [type] $field
     * @param [type] $value
     * @param [type] $satisifer
     * @return void
     */
    protected function email( $field, $value, $satisifer ) {

        return filter_var( $value, FILTER_VALIDATE_EMAIL );
    }

    /**
     * Check alpha numeric
     *
     * @param [type] $field
     * @param [type] $value
     * @param [type] $satisifer
     * @return void
     */
    public function alnum( $field, $value, $satisifer ) {
        return ctype_alnum( $value );
    }

    /**
     * Check alpha
     *
     * @param [type] $field
     * @param [type] $value
     * @param [type] $satisifer
     * @return void
     */
    public function alpha($field, $value, $satisifer) {
        return ctype_alpha($value);
    }

    public function number($field, $value, $satisifer) {
        return is_numeric($value);
    }

    /**
     * Check matched
     *
     * @param [type] $field
     * @param [type] $value
     * @param [type] $satisifer
     * @return void
     */
    protected function match( $field, $value, $satisifer ) {
        return $value === $this->items[$satisifer];
    }

    /**
     * Add errors
     *
     * @param [type] $error
     * @param [type] $key
     * @return void
     */
    public function addError( $error, $key = null ) {
        if ( $key ) {
            $this->errors[$key][] = $error;
        } else {
            $this->errors[] = $error;
        }
    }

    /**
     * All errors
     *
     * @param [type] $key
     * @return array
     */
    public function all( $key = null ) {
        return isset( $this->errors[$key] ) ? $this->errors[$key] : $this->errors;
    }

    /**
     * Check any error has or not
     *
     * @return boolean
     */
    public function hasError() {
        return count( $this->all() ) ? true : false;
    }

    /**
     * Get first error
     *
     * @param string $key
     * @return string
     */
    public function first( $key ) {
        return isset( $this->all()[$key][0] ) ? $this->all()[$key][0] : '';
    }
}