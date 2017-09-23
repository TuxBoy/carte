<?php
namespace Test\TuxBoy\Form;


use PHPUnit\Framework\TestCase;
use TuxBoy\Entity;
use TuxBoy\Form\Builder\EntityFormBuilder;
use TuxBoy\Form\Builder\FormBuilder;

class Fake extends Entity
{
	/**
	 * @var string
	 */
	public $name;
}

class Demo extends Entity
{

	/**
	 * @var string
	 */
	public $name;

	/**
	 * @var string
	 */
	public $slug;

	/**
	 * @var text
	 */
	public $content;

}

class EntityFormBuilderTest extends TestCase
{

	/**
	 * @var EntityFormBuilder
	 */
	private $builder;

	/**
	 * @var FormBuilder
	 */
	private $formBuilder;

	public function setUp()
	{
		$this->formBuilder = new FormBuilder();
		$this->builder = new EntityFormBuilder($this->formBuilder);
	}

	public function testGenerateSimpleForm()
	{
		$entity = new Fake;
		$this->assertContains(
			'<form action="/demo" method="POST"> <div class="form-group"> <input name="name" class="form-control" type="text"> </div> <button type="submit" class="btn btn-primary">Envoyer</button> </form>',
			$this->builder->generateForm($entity, '/demo')
		);
	}

	public function testGenerateFormWithParameters()
	{
		$entity = new Demo();
		$this->assertEquals(
			'<form action="/demo" method="POST"> <div class="form-group"> <input name="name" class="form-control" type="text"> </div> <div class="form-group"> <input name="slug" class="form-control" type="text"> </div> <div class="form-group"> <textarea name="content" class="form-control"></textarea> </div> <button type="submit" class="btn btn-primary">Envoyer</button> </form>',
			$this->builder->generateForm($entity, '/demo')
		);
	}

	public function testGenerateFormWithData()
	{
		$entity = new Demo();
		$entity->name = 'joe';
		$entity->slug = 'un-test';
		$entity->content = 'Du contenu';
		$this->assertEquals(
            '<form action="/demo" method="POST"> <div class="form-group"> <input name="name" value="joe" class="form-control" type="text"> </div> <div class="form-group"> <input name="slug" value="un-test" class="form-control" type="text"> </div> <div class="form-group"> <textarea name="content" class="form-control">Du contenu</textarea> </div> <button type="submit" class="btn btn-primary">Envoyer</button> </form>',
			$this->builder->generateForm($entity, '/demo')
		);
	}

}
