<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\Element\Select;
use Zend\Form\Element\Checkbox;
use Zend\Form\Element\Date;
use Zend\Form\Element\Time;
use Zend\Form\Element\DateTime;

class ConferenceForm extends Form
{
	public function __construct($name = null, $user_id = null, $conference_id = null, $values = array()) {
		parent::__construct($name);
		
		$this->setAttribute('method', 'post');
		$this->setAttribute('class', 'well offset3 span5');
		
		// You'll see _() functions here. This is for the sake of "extractability" :)

		$this->add(array(
			'name' => 'user_id',
			'attributes' => array(
				'type' => 'hidden',
				'value' => $user_id,
			),
		));

		$this->add(array(
			'name' => 'conference_id',
			'attributes' => array(
				'type' => 'hidden',
				'value' => $conference_id,
			),
		));

		$form_name = new Text(
			'name',
			array(
				'label' => _('Conference name'),
			)
		);

		$form_short_name = new Text(
			'short_name',
			array(
				'label' => _('Conference name (short)'),
			)
		);

		$form_description = new Textarea(
			'description',
			array(
				'label' => _('Description'),
			)
		);

		$form_registration_fee = new Textarea(
			'registration_fee',
			array(
				'label' => _('Registration fee'),
			)
		);

		$form_location = new Text(
			'location',
			array(
				'label' => _('Location'),
			)
		);
		
		$form_address = new Text(
			'address',
			array(
				'label' => _('Address'),
			)
		);

		$form_city = new Text(
			'city',
			array(
				'label' => _('City'),
			)
		);

		$form_state = new Text(
			'state',
			array(
				'label' => _('State'),
			)
		);

		$form_country = new Text(
			'country',
			array(
				'label' => _('Country'),
			)
		);
		
		$gmt = new Select('gmt', array('label' => _('GMT')));
		$gmt->setAttributes(
			array(
				'class' => 'span5',
				'options' => array(
					'-12.0' => '(GMT -12:00) Eniwetok, Kwajalein',
					'-11.0' => '(GMT -11:00) Midway Island, Samoa',
					'-10.0' => '(GMT -10:00) Hawaii',
					'-9.0'  => '(GMT -9:00) Alaska',
					'-8.0'  => '(GMT -8:00) Pacific Time (US &amp; Canada)',
					'-7.0'  => '(GMT -7:00) Mountain Time (US &amp; Canada)',
					'-6.0'  => '(GMT -6:00) Central Time (US &amp; Canada), Mexico City',
					'-5.0'  => '(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima',
					'-4.0'  => '(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz',
					'-3.5'  => '(GMT -3:30) Newfoundland',
					'-3.0'  => '(GMT -3:00) Brazil, Buenos Aires, Georgetown',
					'-2.0'  => '(GMT -2:00) Mid-Atlantic',
					'-1.0'  => '(GMT -1:00 hour) Azores, Cape Verde Islands',
					'0.0'   => '(GMT) Western Europe Time, London, Lisbon, Casablanca',
					'1.0'   => '(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris',
					'2.0'   => '(GMT +2:00) Kaliningrad, South Africa',
					'3.0'   => '(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg',
					'3.5'   => '(GMT +3:30) Tehran',
					'4.0'   => '(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi',
					'4.5'   => '(GMT +4:30) Kabul',
					'5.0'   => '(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent',
					'5.5'   => '(GMT +5:30) Bombay, Calcutta, Madras, New Delhi',
					'5.75'  => '(GMT +5:45) Kathmandu',
					'6.0'   => '(GMT +6:00) Almaty, Dhaka, Colombo',
					'7.0'   => '(GMT +7:00) Bangkok, Hanoi, Jakarta',
					'8.0'   => '(GMT +8:00) Beijing, Perth, Singapore, Hong Kong',
					'9.0'   => '(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk',
					'9.5'   => '(GMT +9:30) Adelaide, Darwin',
					'10.0'  => '(GMT +10:00) Eastern Australia, Guam, Vladivostok',
					'11.0'  => '(GMT +11:00) Magadan, Solomon Islands, New Caledonia',
					'12.0'  => '(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka',
				),
			)
		);

		$form_show_running = new Checkbox(
			'show_running',
			array(
				'label' => _('Show alert when conference is running'),
			)
		);

		$form_active = new Checkbox(
			'active',
			array(
				'label' => _('Active'),
			)
		);

		$form_starting_time = new Time(
			'starting_time',
			array(
				'label' => _('Starting Time'),
			)
		);

		$form_first_day = new Date(
			'first_day',
			array(
				'label' => _('First Day'),
			)
		);

		$form_last_day = new Date(
			'last_day',
			array(
				'label' => _('Last Day'),
			)
		);

		$form_cfp_opened = new DateTime(
			'cfp_opened',
			array(
				'label' => _('CFP Opened'),
				'format' => 'Y-m-d H:i:s',
			)
		);

		$form_cfp_closed = new DateTime(
			'cfp_closed',
			array(
				'label' => _('CFP Closed'),
				'format' => 'Y-m-d H:i:s',
			)
		);

		$form_registration_opened = new DateTime(
			'registration_opened',
			array(
				'label' => _('Registration Opened'),
				'format' => 'Y-m-d H:i:s',
			)
		);

		$form_registration_closed = new DateTime(
			'registration_closed',
			array(
				'label' => _('Registration Closed'),
				'format' => 'Y-m-d H:i:s',
			)
		);

		$form_elements = array($form_name, $form_short_name, $form_description, $form_registration_fee, $form_location, $form_address, $form_city, $form_state, $form_country, $gmt, $form_show_running, $form_active, $form_starting_time, $form_first_day, $form_last_day, $form_cfp_opened, $form_cfp_closed, $form_registration_opened, $form_registration_closed);

		foreach ($form_elements as $element) {

			$element_name = $element->getName();
			
			if(isset($values[$element_name])){
				$element->setValue($values[$element_name]);
			}

			$element->setAttributes(array('class' => 'form-control'));

			$this->add($element);

		}

		if(isset($values['show_running'])) $form_show_running->setChecked($values['show_running']);
		if(isset($values['active'])) $form_active->setChecked($values['active']);

		$form_show_running->setAttributes(array('class' => 'checkbox'));
		$form_active->setAttributes(array('class' => 'checkbox'));

		$this->add(array(
			'name' => 'submit',
			'attributes' => array(
				'type'	=> 'submit',
				'id'	=> 'submitbutton',
				'value' => _('Save'),
				'class'	=> 'btn btn-primary btn-large span2',
			),
		));
	}
}