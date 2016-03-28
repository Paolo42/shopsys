<?php

namespace SS6\ShopBundle\Tests\Test\Codeception;

use Codeception\Actor;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use SS6\ShopBundle\Tests\Test\Codeception\_generated\AcceptanceTesterActions;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void haveFriend($name, $actorClass = null)
 * @method \Codeception\Scenario getScenario()
 *
 * @SuppressWarnings(PHPMD)
 */
class AcceptanceTester extends Actor {

	const DEFAULT_AJAX_TIMEOUT_SEC = 10;
	const WAIT_TIMEOUT_SEC = 10;

	use AcceptanceTesterActions;

	public function switchToLastOpenedWindow() {
		$this->executeInSelenium(function (RemoteWebDriver $webdriver) {
			$handles = $webdriver->getWindowHandles();
			$lastWindow = end($handles);
			$this->switchToWindow($lastWindow);
		});
		$this->waitForElement('body', self::WAIT_TIMEOUT_SEC);
	}

	/**
	 * @param int $timeout
	 */
	public function waitForAjax($timeout = self::DEFAULT_AJAX_TIMEOUT_SEC) {
		$this->waitForJS('return $.active == 0;', $timeout);
	}

	/**
	 * @param string $username
	 * @param string $password
	 */
	public function loginAsAdmin($username, $password) {
		$this->amOnPage('/admin/');
		$this->fillFieldByName('admin_login_form[username]', $username);
		$this->fillFieldByName('admin_login_form[password]', $password);
		$this->clickByText('Přihlásit');
	}
}
