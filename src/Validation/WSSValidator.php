<?php
declare(strict_types = 1);

namespace WSSCore\Validation;


class WSSValidator extends \Cake\Validation\Validator
{

    /**
     * WSSValidator constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->setProvider('wss', WSSValidation::class);
    }


    /**
     * Add a phone rule to a field.
     *
     * @param string $field The field you want to apply the rule to.
     * @param string|null $message The error message when the rule fails.
     * @param string|callable|null $when Either 'create' or 'update' or a callable that returns
     *   true when the validation rule should be applied.
     * @return $this
     * @see \WSSCore\Validation\WSSValidation::isValidPhone()
     */
    public function phone(string $field, ?string $message = null, $when = null)
    {
        $message = empty($message) ? __('Telefone inválido') : $message;
        $extra = array_filter(['on' => $when, 'message' => $message]);

        return $this->add($field, 'validPhone', $extra + [
                'rule' => 'isValidPhone',
                'provider' => 'wss'
            ]);
    }

    /**
     * Add a cellphone rule to a field.
     *
     * @param string $field The field you want to apply the rule to.
     * @param string|null $message The error message when the rule fails.
     * @param string|callable|null $when Either 'create' or 'update' or a callable that returns
     *   true when the validation rule should be applied.
     * @return $this
     * @see \WSSCore\Validation\WSSValidation::isValidCellphone()
     */
    public function cellphone(string $field, ?string $message = null, $when = null)
    {
        $message = empty($message) ? __('Celular inválido') : $message;
        $extra = array_filter(['on' => $when, 'message' => $message]);

        return $this->add($field, 'validCellphone', $extra + [
                'rule' => 'isValidCellphone',
                'provider' => 'wss'
            ]);
    }

    /**
     * Add a cpf rule to a field.
     *
     * @param string $field The field you want to apply the rule to.
     * @param string|null $message The error message when the rule fails.
     * @param string|callable|null $when Either 'create' or 'update' or a callable that returns
     *   true when the validation rule should be applied.
     * @return $this
     * @see \WSSCore\Validation\WSSValidation::isValidCpf()
     */
    public function cpf(string $field, ?string $message = null, $when = null)
    {
        $message = empty($message) ? __('CPF inválido') : $message;
        $extra = array_filter(['on' => $when, 'message' => $message]);

        return $this->add($field, 'validCpf', $extra + [
                'rule' => 'isValidCpf',
                'provider' => 'wss'
            ]);
    }

    /**
     * Add a cnpj rule to a field.
     *
     * @param string $field The field you want to apply the rule to.
     * @param string|null $message The error message when the rule fails.
     * @param string|callable|null $when Either 'create' or 'update' or a callable that returns
     *   true when the validation rule should be applied.
     * @return $this
     * @see \WSSCore\Validation\WSSValidation::isValidCnpj()
     */
    public function cnpj(string $field, ?string $message = null, $when = null)
    {
        $message = empty($message) ? __('CNPJ inválido') : $message;
        $extra = array_filter(['on' => $when, 'message' => $message]);

        return $this->add($field, 'validCnpj', $extra + [
                'rule' => 'isValidCnpj',
                'provider' => 'wss'
            ]);
    }

    /**
     * Add a cnpj rule to a field.
     *
     * @param string $field The field you want to apply the rule to.
     * @param string|null $message The error message when the rule fails.
     * @param string|callable|null $when Either 'create' or 'update' or a callable that returns
     *   true when the validation rule should be applied.
     * @return $this
     * @see \WSSCore\Validation\WSSValidation::isValidCpfOrCnpj()
     */
    public function cpfOrCnpj(string $field, ?string $message = null, $when = null)
    {
        $message = empty($message) ? __('Documento inválido') : $message;
        $extra = array_filter(['on' => $when, 'message' => $message]);

        return $this->add($field, 'validCpfOrCnpj', $extra + [
                'rule' => 'isValidCpfOrCnpj',
                'provider' => 'wss'
            ]);
    }

    /**
     * @param string $field The field you want to apply the rule to.
     * @param string $secondField The field you want to compare against.
     * @param string|null $message The error message when the rule fails.
     * @param string|callable|null $when Either 'create' or 'update' or a callable that returns
     * @return \WSSCore\Validation\WSSValidator
     */
    public function dateTimeLessThanField(string $field, string $secondField, ?string $message = null, $when = null)
    {
        $message = empty($message) ? __('A data deve ser menor que "{0}"', $secondField) : $message;
        $extra = array_filter(['on' => $when, 'message' => $message]);

        return $this->add($field, 'dateTimeLessThanField', $extra + [
                'rule' => ['isDateTimeLessThanField', $secondField],
                'provider' => 'wss'
            ]);
    }

    /**
     * @param string $field The field you want to apply the rule to.
     * @param string $secondField The field you want to compare against.
     * @param string|null $message The error message when the rule fails.
     * @param string|callable|null $when Either 'create' or 'update' or a callable that returns
     * @return \WSSCore\Validation\WSSValidator
     */
    public function dateTimeGreaterThanField(string $field, string $secondField, ?string $message = null, $when = null)
    {
        $message = empty($message) ? __('A data deve ser maior que "{0}"', $secondField) : $message;
        $extra = array_filter(['on' => $when, 'message' => $message]);

        return $this->add($field, 'dateTimeGreaterThanField', $extra + [
                'rule' => ['isDateTimeGreaterThanField', $secondField],
                'provider' => 'wss'
            ]);
    }
}