<?php
declare(strict_types=1);

namespace Toolkit\View\Helper;

use Cake\Utility\Inflector;
use Cake\View\Form\EntityContext;
use Cake\View\Helper\FormHelper;

/**
 * B5Form helper
 */
class B5FormHelper extends FormHelper
{

    /**
     * @inheritDoc
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setConfig('errorClass', 'is-invalid');
        $templates = $this->getTemplates();
        $templates['bs5CheckboxWrapper'] = '<div class="form-check mb-3">{{input}}{{label}}</div>';
        $templates['bs5CheckboxWrapperError'] = '<div class="form-check mb-3">{{input}}{{label}}{{error}}</div>';
        $templates['bs5CheckboxLabel'] = '<label class="form-check-label" for="{{for}}">{{content}}</label>';
        $templates['checkbox'] = '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>';
        $templates['inputContainer'] = '<div class="form-floating mb-3 {{type}}{{required}}">{{content}}</div>';
        $templates['inputContainerError'] = '<div class="form-floating mb-3 {{type}}{{required}}">{{content}}{{error}}</div>';
        $templates['formGroup'] = '{{input}}{{label}}';
        $templates['error'] = '<div class="invalid-feedback">{{content}}</div>';
        $templates['errorList'] = '<ul role="list">{{content}}</ul>';
        $this->setTemplates($templates);
    }

    /**
     * @inheritDoc
     */
    public function control(string $fieldName, array $options = []): string
    {
        $options['placeholder'] = !empty($options['label']) ? $options['label'] : Inflector::humanize(Inflector::underscore($fieldName));
        $options['class'] = !empty($options['class']) ? explode(' ', $options['class']) : [];
        $options['class'][] = 'form-control';

        $entity = $this->_getContext();
        if ($entity instanceof EntityContext && $entity->entity()->hasErrors()) {
            if (!$this->isFieldError($fieldName)) {
                $options['class'][] = 'is-valid';
            }
        }

        $options['class'] = implode(' ', $options['class']);
        return parent::control($fieldName, $options);
    }

    /**
     * @inheritDoc
     */
    public function checkbox(string $fieldName, array $options = [])
    {
        $id = $this->_domId($fieldName);
        $options['label'] = !empty($options['label']) ? $options['label'] : Inflector::humanize(Inflector::underscore($fieldName));
        $options['id'] = $id;
        $options['class'] = !empty($options['class']) ? explode(' ', $options['class']) : [];
        $options['class'][] = 'form-check-input';
        $checkbox = parent::checkbox($fieldName, $options);
        $label = $this->templater()->format('bs5CheckboxLabel', ['for' => $id, 'content' => $options['label']]);
        $error = $this->isFieldError($fieldName) ? $this->error($fieldName) : '';
        $templateName = $this->isFieldError($fieldName) ?  'bs5CheckboxWrapperError' : 'bs5CheckboxWrapper';

        return $this->templater()->format($templateName, [
            'input' => $checkbox,
            'label' => $label,
            'error' => $error,
        ]);

    }
}
