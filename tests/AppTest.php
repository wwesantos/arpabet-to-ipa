<?php
/*
*  Arpabet-to-IPA - converting Arpabet to IPA.
* 
* @author		Waldeilson Eder dos Santos
* @copyright 	Copyright (c) 2015 Waldeilson Eder dos Santos
* @link			https://github.com/wwesantos/arpabet-to-ipa
* @package     arpabet-to-ipa
*
* The MIT License (MIT)
* 
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
* 
* The above copyright notice and this permission notice shall be included in all
* copies or substantial portions of the Software.
* 
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
* SOFTWARE.
*/

require_once './../src/App.php';
use ArpabetToIPA\App;

class AppTest extends PHPUnit_Framework_TestCase
{
	
	private $convertionTable = array(
		'AO' => 'ɔ', 'AO0' => 'ɔ', 'AO1' => 'ɔ', 'AO2' => 'ɔ', 'AA' => 'ɑ', 'AA0' => 'ɑ', 'AA1' => 'ɑ', 'AA2' => 'ɑ',
		'IY' => 'i','IY0' => 'i','IY1' => 'i','IY2' => 'i','UW' => 'u','UW0' => 'u','UW1' => 'u','UW2' => 'u',
		'EH' => 'e', 'EH0' => 'e', 'EH1' => 'e', 'EH2' => 'e', 'IH' => 'ɪ', 'IH0' => 'ɪ', 'IH1' => 'ɪ', 'IH2' => 'ɪ', 
		'UH' => 'ʊ', 'UH0' => 'ʊ', 'UH1' => 'ʊ', 'UH2' => 'ʊ', 'AH' => 'ʌ', 'AH0' => 'ə', 'AH1' => 'ʌ', 'AH2' => 'ʌ', 
		'AE' => 'æ', 'AE0' => 'æ', 'AE1' => 'æ', 'AE2' => 'æ', 'AX' => 'ə', 'AX0' => 'ə', 'AX1' => 'ə', 'AX2' => 'ə',
		'EY' => 'eɪ','EY0' => 'eɪ','EY1' => 'eɪ','EY2' => 'eɪ','AY' => 'aɪ', 'AY0' => 'aɪ', 'AY1' => 'aɪ', 'AY2' => 'aɪ',
		'OW' => 'oʊ', 'OW0' => 'oʊ', 'OW1' => 'oʊ', 'OW2' => 'oʊ', 'AW' => 'aʊ', 'AW0' => 'aʊ', 'AW1' => 'aʊ', 'AW2' => 'aʊ', 
		'OY' => 'ɔɪ', 'OY0' => 'ɔɪ', 'OY1' => 'ɔɪ', 'OY2' => 'ɔɪ', 'P' => 'p', 'B' => 'b', 'T' => 't', 'D' => 'd', 
		'K' => 'k', 'G' => 'g', 'CH' => 'tʃ', 'JH' => 'dʒ', 'F' => 'f', 'V' => 'v', 'TH' => 'θ', 'DH' => 'ð', 
		'S' => 's', 'Z' => 'z', 'SH' => 'ʃ', 'ZH' => 'ʒ', 'HH' => 'h', 'M' => 'm', 'N' => 'n', 'NG' => 'ŋ', 
		'L' => 'l', 'R' => 'r', 'ER' => 'ɜr', 'ER0' => 'ɜr', 'ER1' => 'ɜr', 'ER2' => 'ɜr', 'AXR' => 'ər',
		'AXR0' => 'ər','AXR1' => 'ər','AXR2' => 'ər','W' => 'w','Y' => 'j'
	);
		
	
		/**
		 * Tests with the default table 
		 */
		
		/**
		 * @expectedException InvalidArgumentException
		 * @expectedExceptionMessage arpabet phoneme cannot be null
		 */
		public function testExceptionEmptyPhoneme(){
			$app = new App();
			$phoneme = $app->getIPA('');
		}
		
		/**
		 * @expectedException InvalidArgumentException
		 * @expectedExceptionMessage arpabet phoneme cannot be null
		 */
		public function testExceptionSpacePhoneme(){
			$app = new App();
			$phoneme = $app->getIPA(' ');
		}
		
		/**
		 * @expectedException InvalidArgumentException
		 * @expectedExceptionMessage was not found
		 */
		public function testExceptionInvalidPhoneme(){
			$app = new App();
			$phoneme = $app->getIPA('CCC');
		}

		public function testSuccessValidPhoneme(){
			$app = new App();
			$returned = $app->getIpa('AA');
			$expected = $this->convertionTable['AA'];
			$this->assertEquals($returned,$expected);
		}
		
		public function testSuccessTwoValidPhonemes(){
			$app = new App();
			$returned = $app->getIpa('AA AH0');
			$expected = $this->convertionTable['AA'].$this->convertionTable['AH0'];
			$this->assertEquals($returned,$expected);
		}
		
		
		public function testSuccessValidPhonemeAndSpaces(){
			$app = new App();
			$returned = $app->getIpa(' AA  AH0             EY0 AX0         AXR	 ');
			$expected = $this->convertionTable['AA'].
				$this->convertionTable['AH0'].
				$this->convertionTable['EY0'].
				$this->convertionTable['AX0'].
				$this->convertionTable['AXR'];
			$this->assertEquals($returned,$expected);
		}
		
		/**
		 * @expectedException InvalidArgumentException
		 * @expectedExceptionMessage phoneme "INVALID-PHONEME" was not found
		 */
		public function testExceptionValidPhonemesAndSpacesAndOneInvalidPronene(){
			$app = new App();
			$returned = $app->getIpa(' AA  AH0             EY0 AX0     INVALID-PHONEME   AXR ');
		}
	
 		public function testSuccessEntireTable(){
			$app = new App();
			foreach ($this->convertionTable as $key => $expected){
				$returned = $app->getIPA($key); 
				$this->assertEquals($returned, $expected);
			}
		}
		
		public function testSuccessWords(){
			$app = new App();
			$this->assertEquals($app->getIPA(' AH0  B AW1 T  '), 'əbaʊt');
			$this->assertEquals($app->getIPA(' AE1 G R AH0 B IH2 Z N AH0 S'), 'ægrəbɪznəs');
			$this->assertEquals($app->getIPA('   B EH0 L OW1  '), 'beloʊ');
		}
		
		
		/**
		 * Tests with the user table
		 */
		
		/**
		 * @expectedException InvalidArgumentException
		 * @expectedExceptionMessage Arpabet-to-IPA::invalid convertionTable
		 */
		public function testExceptionNullUserTable(){
			$app = new App();
			$app->setConvertionTable(null);
		}
		
		/**
		 * @expectedException InvalidArgumentException
		 * @expectedExceptionMessage Arpabet-to-IPA::invalid convertionTable
		 */
		public function testExceptionEmptyUserTable(){
			$app = new App();
			$app->setConvertionTable('');
		}
		
		/**
		 * @expectedException InvalidArgumentException
		 * @expectedExceptionMessage Arpabet-to-IPA::invalid convertionTable
		 */
		public function testExceptionIntegerUserTable(){
			$app = new App();
			$app->setConvertionTable(2012);
		}
		
		/**
		 * @expectedException InvalidArgumentException
		 * @expectedExceptionMessage Arpabet-to-IPA::invalid convertionTable
		 */
		public function testExceptionStringUserTable(){
			$app = new App();
			$app->setConvertionTable('adsasdsad');
		}
		
		/**
		 * @expectedException InvalidArgumentException
		 * @expectedExceptionMessage Arpabet-to-IPA::invalid convertionTable
		 */
		public function testExceptionInvalidArray(){
			$app = new App();
			$app->setConvertionTable(array('x','y'));
		}
		
		
		public function testSucessUserTable(){
			$app = new App();
			$app->setConvertionTable(array('X'=>'x', 'Y'=>'y'));
		}
		
		
		/**
		 * @expectedException InvalidArgumentException
		 * @expectedExceptionMessage arpabet phoneme cannot be null
		 */
		public function testExceptionUserTableAndEmptyPhoneme(){
			$app = new App();
			$app->setConvertionTable(array('X'=>'x', 'Y'=>'y'));
			$phoneme = $app->getIPA('');
		}
		
		/**
		 * @expectedException InvalidArgumentException
		 * @expectedExceptionMessage arpabet phoneme cannot be null
		 */
		public function testExceptionUserTableAndSpacePhoneme(){
			$app = new App();
			$app->setConvertionTable(array('X'=>'x', 'Y'=>'y'));
			$phoneme = $app->getIPA(' ');
		}
		
		/**
		 * @expectedException InvalidArgumentException
		 * @expectedExceptionMessage was not found
		 */
		public function testExceptionUserTableAndInvalidPhoneme(){
			$app = new App();
			$app->setConvertionTable(array('X'=>'x', 'Y'=>'y'));
			$phoneme = $app->getIPA('CCC');
		}
		
		public function testSuccessUserTableAndValidPhoneme(){
			$app = new App();
			$app->setConvertionTable(array('X'=>'a', 'Y'=>'b'));
			$returned = $app->getIpa('X');
			$expected = 'a';
			$this->assertEquals($returned,$expected);
		}
		
		public function testSuccessUserTableAndTwoValidPhonemes(){
			$app = new App();
			$app->setConvertionTable(array('X'=>'a', 'Y'=>'b'));
			$returned = $app->getIpa('X Y');
			$expected = 'ab';
			$this->assertEquals($returned,$expected);
		}
		
		
		public function testSuccessUserTableValidPhonemeAndSpaces(){
			$app = new App();
			$app->setConvertionTable(array('X'=>'a', 'Y'=>'b'));
			$returned = $app->getIpa(' X    Y        X X     Y Y      Y  ');
			$expected = 'abaabbb';
			$this->assertEquals($returned,$expected);
		}
		
		/**
		 * @expectedException InvalidArgumentException
		 * @expectedExceptionMessage phoneme "INVALID-PHONEME" was not found
		 */
		public function testExceptionUserTableValidPhonemesAndSpacesAndOneInvalidPronene(){
			$app = new App();
			$app->setConvertionTable(array('X'=>'a', 'Y'=>'b'));
			$returned = $app->getIpa(' X  X             Y Y     INVALID-PHONEME   X ');
		}
		
		public function testSuccessUserTableEntireTable(){
			$app = new App();
			$convertionTable = array('X'=>'a', 'Y'=>'b');
			$app->setConvertionTable($convertionTable);
			foreach ($convertionTable as $key => $expected){
				$returned = $app->getIPA($key);
				$this->assertEquals($returned, $expected);
			}
		}
}