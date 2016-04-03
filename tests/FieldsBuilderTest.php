<?php

namespace Understory\Fields\Tests;

use Understory\Fields\FieldsBuilder;

class FieldsBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('Understory\Fields\FieldsBuilder'));
    }

    public function testInstantiation()
    {
        $builder = new FieldsBuilder('fields');

        $this->assertTrue(is_a($builder, 'Understory\Fields\FieldsBuilder'));
    }

    public function testBuildReturnsArray()
    {
        $builder = new FieldsBuilder('fields');

        $this->assertInternalType('array', $builder->build());
    }

    public function testCreateGroup()
    {
        $builder = new FieldsBuilder('my_fields');

        $expectedConfig = [
            'key' => 'group_my_fields',
            'title' => 'My Fields',
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testGroupConfig()
    {
        $builder = new FieldsBuilder('my_fields', ['style' => 'seamlees']);

        $expectedConfig = [
            'key' => 'group_my_fields',
            'title' => 'My Fields',
            'style' => 'seamlees',
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testGroupConfigOverride()
    {
        $builder = new FieldsBuilder('my_fields', ['style' => 'seamlees']);
        $builder->setGroupConfig('my_fields', ['title' => 'My New Field Group']);

        $expectedConfig = [
            'key' => 'group_my_fields',
            'title' => 'My New Field Group',
            'style' => 'seamlees',
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testChainableAddField()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addField('name')
                ->addField('name_two');

        $expectedConfig = [
            'fields' => [
                [
                    'key' => 'field_name',
                    'name' => 'name',
                    'label' => 'Name',
                ],
                [
                    'key' => 'field_name_two',
                    'name' => 'name_two',
                    'label' => 'Name Two',
                ],
            ],            
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }    

    public function testAddText()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addText('name');

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'name',
                    'type' => 'text',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddTextarea()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addTextarea('name');

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'name',
                    'type' => 'textarea',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddNumber()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addNumber('name', ['min' => '1']);

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'name',
                    'type' => 'number',
                    'min' => '1',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddEmail()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addEmail('email');

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'email',
                    'type' => 'email',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }    

    public function testAddUrl()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addUrl('location');

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'location',
                    'type' => 'url',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddPassword()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addPassword('password');

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'password',
                    'type' => 'password',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddWysiwyg()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addWysiwyg('name');

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'name',
                    'type' => 'wysiwyg',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddOembed()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addOembed('name');

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'name',
                    'type' => 'oembed',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddImage()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addImage('name');

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'name',
                    'type' => 'image',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddFile()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addFile('name');

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'name',
                    'type' => 'file',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddGallery()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addGallery('name');

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'name',
                    'type' => 'gallery',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddTrueFalse()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addTrueFalse('name');

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'name',
                    'type' => 'true_false',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddSelect()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addSelect('colors', ['choices' => ['yellow' => 'Yellow']])
                    ->addChoice('red', 'Rojo')
                    ->addChoice('blue')
                    ->addChoice('green');

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'colors',
                    'type' => 'select',
                    'choices' => [
                        'yellow' => 'Yellow',
                        'red' => 'Rojo',
                        'blue' => 'blue',
                        'green' => 'green',
                    ],
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddRadio()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addRadio('colors')
                    ->addChoice('red')
                    ->addChoice('blue')
                    ->addChoice('green');

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'colors',
                    'type' => 'radio',
                    'choices' => [
                        'red' => 'red',
                        'blue' => 'blue',
                        'green' => 'green',
                    ],
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddCheckbox()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addCheckbox('colors')
                    ->addChoice('red')
                    ->addChoice('blue')
                    ->addChoice('green');

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'colors',
                    'type' => 'checkbox',
                    'choices' => [
                        'red' => 'red',
                        'blue' => 'blue',
                        'green' => 'green',
                    ],
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddPostObject()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addPostObject('related_page')
                    ->setConfig('post_type', 'page');

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'related_page',
                    'type' => 'post_object',
                    'post_type' => 'page',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddPostList()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addPostLink('related_page');

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'related_page',
                    'type' => 'post_link',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddRelationship()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addRelationship('related_page');

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'related_page',
                    'type' => 'relationship',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddTaxonomy()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addTaxonomy('category');

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'category',
                    'type' => 'taxonomy',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddUser()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addUser('member');

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'member',
                    'type' => 'user',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddDatePicker()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addDatePicker('start_date');

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'start_date',
                    'type' => 'date_picker',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddColorPicker()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addColorPicker('background_color');

        $expectedConfig =  [
            'fields' => [
                [
                    'name' => 'background_color',
                    'type' => 'color_picker',
                ],
            ],
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testRequired()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addField('name')->required()
                ->addField('name_two')->required(true)
                ->addField('name_three')
                ->addField('name_four')->required(false)
                ->addField('name_five', ['required' => 1]);

        $expectedConfig = [
            'fields' => [
                [
                    'name' => 'name',
                    'required' => 1,
                ],
                [
                    'name' => 'name_two',
                    'required' => 1,
                ],
                [
                    'name' => 'name_three',
                ],
                [
                    'name' => 'name_four',
                    'required' => 0,
                ],
                [
                    'name' => 'name_five',
                    'required' => 1,
                ],
            ],            
        ];

        $config = $builder->build();

        $this->assertArraySubset($expectedConfig, $config);
        $this->assertArrayNotHasKey('required', $config['fields'][2]);
    }

    public function testInstructions()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addField('name')
                    ->instructions('Last Name, First Name');

        $expectedConfig = [
            'fields' => [
                [
                    'name' => 'name',
                    'instructions' => 'Last Name, First Name',
                ],
            ],            
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testDefault()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addField('name')
                    ->default('John Smith');

        $expectedConfig = [
            'fields' => [
                [
                    'name' => 'name',
                    'default_value' => 'John Smith',
                ],
            ],            
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddTab()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addTab('Content')
                    ->addText('name')
                ->addTab('Background Color')->endpoint()
                    ->addColorPicker('background_color');

        $expectedConfig = [
            'fields' => [
                [
                    'key' => 'field_content_tab',
                    'name' => 'content_tab',
                    'label' => 'Content',
                    'type' => 'tab',
                ],
                [
                    'name' => 'name',
                ],
                [
                    'key' => 'field_background_color_tab',
                    'name' => 'background_color_tab',
                    'label' => 'Background Color',
                    'type' => 'tab',
                    'endpoint' => 1,
                ],
                [
                    'name' => 'background_color',
                ],
            ],            
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }

    public function testAddMessage()
    {
        $builder = new FieldsBuilder('fields');
        $builder->addMessage('Warning', 'This is my message');

        $expectedConfig = [
            'fields' => [
                [
                    'key' => 'field_warning_message',
                    'name' => 'warning_message',
                    'label' => 'Warning',
                    'message' => 'This is my message',
                ],
            ],            
        ];

        $this->assertArraySubset($expectedConfig, $builder->build());
    }
}
