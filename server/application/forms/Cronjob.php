<?php
class Cronphp_Form_Cronjob extends Zend_Form {

    private function getElementDecorators($type = 'text') {
        return array(
            'ViewHelper',
            array(
                array('InputWrapper' => 'HtmlTag'),
                array(
                    'tag' => 'div',
                    'class' => 'input',
                ),
            ),
            'Description',
            'Errors',
            'Label',
            array(
                array('ClearfixWrapper' => 'HtmlTag'),
                array(
                    'tag' => 'div',
                    'class' => 'clearfix',
                ),
            ),
        );
    }

    public function addServers($servers) {
        $serverlist = $this->getElement('server');

        foreach ($servers as $server) {
            $serverlist->addMultiOption($server->hostname, $server->hostname);
        }
    }

    public function init() {
        $this->setMethod('post');

        $this->loadDefaultDecorators();
        $this->removeDecorator('HtmlTag');

        $this->addDisplayGroup(array(
            new Zend_Form_Element_Select('server', array(
                'required'   => true,
                'label'      => 'Server to run the job:',
                'decorators' => $this->getElementDecorators(),
                'multiOptions' => array(),
                'filters'    => array('StringTrim'),
            )),
            new Zend_Form_Element_Text('path', array(
                'required'   => true,
                'label'      => 'Path to cronjob:',
                'decorators' => $this->getElementDecorators(),
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
                'decorators' => $this->getElementDecorators(),
                'filters'    => array('StringTrim'),
                'validators' => array(
                    array('Regex',
                          false,
                          array('/^[a-z][a-z0-9., \'-]{2,}$/i'))
                )
            )),
        ), 'serverData', array('legend' => 'Cronjob'));

        $this->addDisplayGroup(array(
            new Zend_Form_Element_Text('minute', array(
                'required'   => true,
                'label'      => 'Minute',
                'decorators' => $this->getElementDecorators(),
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
                'decorators' => $this->getElementDecorators(),
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
                'decorators' => $this->getElementDecorators(),
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
                'decorators' => $this->getElementDecorators(),
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
                'decorators' => $this->getElementDecorators(),
                'filters'    => array('StringTrim'),
                'validators' => array(
                    array('Regex',
                          false,
                          array('/^[0-9\/*]*$/'))
                )
            )),
        ), 'time', array('legend' => 'When'));

        $this->addElement(new Zend_Form_Element_Submit('submit', array(
                'label'      => 'Add job',
                'class'      => array('btn', 'primary'),
                'decorators' => array(
                    'ViewHelper',
                    array(
                        array('ActionsWrapper' => 'HtmlTag'),
                        array(
                            'tag' => 'div',
                            'class' => 'actions',
                        ),
                    ),
                ),
            ))
        );

        foreach ($this->getDisplayGroups() as $group) {
            $group->removeDecorator('HtmlTag');
            $group->removeDecorator('DtDdWrapper');
        }
    }
}
