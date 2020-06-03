<?php namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	public $login = [
		'email' => [
			'rules' => 'required|valid_email',
			'errors' => [
				'required' => 'Email required',
				'valid_email' => "Please input a valid email"
			]
		],
		'password' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'Password required'
			]
		]
	];

	public $validate_photo = [
		'upload_foto' => [
			'rules' => 'uploaded[upload_foto]|ext_in[upload_foto,png,jpg,gif,jpeg,tif]|max_size[upload_foto,1000000]'
		]
	];
}
