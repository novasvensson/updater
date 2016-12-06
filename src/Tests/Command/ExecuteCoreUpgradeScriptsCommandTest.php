<?php

namespace Owncloud\Updater\Tests\Command;


class ExecuteCoreUpgradeScriptsCommandTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @dataProvider versionProvider
	 * @param string $installedVersion
	 * @param string $packageVersion
	 * @param string $canBeUpgradedFrom
	 * @param bool $expectedResult
	 */
	public function testIsUpgradeAllowed($installedVersion, $packageVersion, $canBeUpgradedFrom, $expectedResult){
		$commmandMock = $this->getMockBuilder('\Owncloud\Updater\Command\ExecuteCoreUpgradeScriptsCommand')
			->disableOriginalConstructor()
			->setMethods(null)
			->getMock()
		;
		$actualResult = $commmandMock->isUpgradeAllowed($installedVersion, $packageVersion, $canBeUpgradedFrom);
		$this->assertEquals($expectedResult, $actualResult);
	}

	public function versionProvider(){
		return [
			[ '9.0.1.2', '9.0.4.2', '8.2', true ],
			[ '9.0.4.2', '9.0.1.2', '8.2', false ],
			[ '9.0.4.2', '9.1.1.3', '9.0', true ],

			[ '9.1.1.3', '9.1.2.0', '9.0', true ],
			[ '9.1.2.0', '9.1.1.3', '9.0', false ],
			[ '9.1.1.3', '9.2.0.3', '9.1', true ],

			[ '9.2.0.3', '9.2.1.2', '9.1', true ],
			[ '9.2.1.2', '9.2.0.3', '9.1', false ],
		];
	}
}
