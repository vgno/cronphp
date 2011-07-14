<?php
class Application_Form_Cronjob extends Zend_Form {

    public function init() {
        /* Form Elements & Other Definitions Here ... */
        $this->setAttrib('class', 'dataSet')
             ->setMethod('post');

        $this->addElements(array(
            new Zend_Form_Element_Text('server', array(
                'required'   => true,
                'label'      => 'Server to run the job:',
                'filters'    => array('StringTrim'),
                'validators' => array(
                    array('Regex',
                          false,
                          array('/^[a-z][a-z0-9., \'-]{2,}$/i'))
                )
            )),
            new Zend_Form_Element_Text('path', array(
                'required'   => true,
                'label'      => 'Path to cronjob:',
                'filters'    => array('StringTrim'),
                'validators' => array(
                    array('Regex',
                          false,
                          array('/^[a-z0-9.,\/ \'-]{2,}$/i'))
                )
            )),
            new Zend_Form_Element_Text('user', array(
                'required'   => true,
                'label'      => 'User to run as',
                'filters'    => array('StringTrim'),
                'validators' => array(
                    array('Regex',
                          false,
                          array('/^[a-z][a-z0-9., \'-]{2,}$/i'))
                )
            )),
            new Zend_Form_Element_Text('minute', array(
                'required'   => true,
                'label'      => 'Minute',
                'filters'    => array('StringTrim'),
                'validators' => array(
                    array('Regex',
                          false,
                          array('/^[0-9\/*]*$/'))
                )
            )),
            new Zend_Form_Element_Text('hour', array(
                'required'   => true,
                'label'      => 'Hour',
                'filters'    => array('StringTrim'),
                'validators' => array(
                    array('Regex',
                          false,
                          array('/^[0-9\/*]*$/'))
                )
            )),
            new Zend_Form_Element_Text('dayOfMonth', array(
                'required'   => true,
                'label'      => 'Day of month',
                'filters'    => array('StringTrim'),
                'validators' => array(
                    array('Regex',
                          false,
                          array('/^[0-9\/*]*$/'))
                )
            )),
            new Zend_Form_Element_Text('month', array(
                'required'   => true,
                'label'      => 'Month',
                'filters'    => array('StringTrim'),
                'validators' => array(
                    array('Regex',
                          false,
                          array('/^[0-9\/*]*$/'))
                )
            )),
            new Zend_Form_Element_Text('dayOfWeek', array(
                'required'   => true,
                'label'      => 'Day of week',
                'filters'    => array('StringTrim'),
                'validators' => array(
                    array('Regex',
                          false,
                          array('/^[0-9\/*]*$/'))
                )
            )),
            new Zend_Form_Element_Submit('submit', array(
                'label'      => 'Add job'
            )),
        ));

    }
}
