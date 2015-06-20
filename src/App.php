<?php
/*
*  Arpabet-to-IPA - converting Arpabet to IPA.
* 
* @author		Waldeilson Eder dos Santos
* @copyright 	Copyright (c) 2015 Waldeilson Eder dos Santos
* @link			https://github.com/wwesantos/arpabet-to-ipa
* @package     	arpabet-to-ipa
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

namespace ArpabetToIPA;

/**
 * @author Waldeilson
 *
 */
class App
{
	
	/*
	 * Reference: https://en.wikipedia.org/wiki/Arpabet
	 *
	 * In Arpabet, every phoneme is represented by one or two capital letters.
	 * Digits are used as stress indicators and are placed at the end of the stressed syllabic vowel.
	 * Punctuation marks are used like in the written language, to represent intonation changes at the end of clauses and sentences.
	 * The stress values are:
	 * Value Description
	 * 0 No stress
	 * 1 Primary stress
	 * 2 Secondary stress
	 */
	
	private $convertionTable = array(
		/*
		 Vowels - Monophthongs
		Arpabet	IPA		Word examples
		AO		ɔ		off (AO1 F); fall (F AO1 L); frost (F R AO1 S T)
		AA		ɑ		father (F AA1 DH ER), cot (K AA1 T)
		IY		i		bee (B IY1); she (SH IY1)
		UW		u		you (Y UW1); new (N UW1); food (F UW1 D)
		EH		ɛ OR e 	ed (R EH1 D); men (M EH1 N)
		IH		ɪ		big (B IH1 G); win (W IH1 N)
		UH		ʊ		should (SH UH1 D), could (K UH1 D)
		AH		ʌ		but (B AH1 T), sun (S AH1 N)
		AH(AH0) ə		sofa (S OW1 F AH0), alone (AH0 L OW1 N)
		AE		æ		at (AE1 T); fast (F AE1 S T)
		AX		ə 		discus (D IH1 S K AX0 S);
		*/
			'AO' => 'ɔ',
			'AO0' => 'ɔ',
			'AO1' => 'ɔ',
			'AO2' => 'ɔ',
			'AA' => 'ɑ',
			'AA0' => 'ɑ',
			'AA1' => 'ɑ',
			'AA2' => 'ɑ',
			'IY' => 'i',
			'IY0' => 'i',
			'IY1' => 'i',
			'IY2' => 'i',
			'UW' => 'u',
			'UW0' => 'u',
			'UW1' => 'u',
			'UW2' => 'u',
			'EH' => 'e', // modern versions use 'e' instead of 'ɛ'
			'EH0' => 'e', // ɛ
			'EH1' => 'e', // ɛ
			'EH2' => 'e', // ɛ
			'IH' => 'ɪ',
			'IH0' => 'ɪ',
			'IH1' => 'ɪ',
			'IH2' => 'ɪ',
			'UH' => 'ʊ',
			'UH0' => 'ʊ',
			'UH1' => 'ʊ',
			'UH2' => 'ʊ',
			'AH' => 'ʌ',
			'AH0' => 'ə',
			'AH1' => 'ʌ',
			'AH2' => 'ʌ',
			'AE' => 'æ',
			'AE0' => 'æ',
			'AE1' => 'æ',
			'AE2' => 'æ',
			'AX' => 'ə',
			'AX0' => 'ə',
			'AX1' => 'ə',
			'AX2' => 'ə',
		/*
		Vowels - Diphthongs
		Arpabet	IPA	Word Examples
		EY		eɪ	say (S EY1); eight (EY1 T)
		AY		aɪ	my (M AY1); why (W AY1); ride (R AY1 D)
		OW		oʊ	show (SH OW1); coat (K OW1 T)
		AW		aʊ	how (HH AW1); now (N AW1)
		OY		ɔɪ	boy (B OY1); toy (T OY1)
		*/
			'EY' => 'eɪ',
			'EY0' => 'eɪ',
			'EY1' => 'eɪ',
			'EY2' => 'eɪ',
			'AY' => 'aɪ',
			'AY0' => 'aɪ',
			'AY1' => 'aɪ',
			'AY2' => 'aɪ',
			'OW' => 'oʊ',
			'OW0' => 'oʊ',
			'OW1' => 'oʊ',
			'OW2' => 'oʊ',
			'AW' => 'aʊ',
			'AW0' => 'aʊ',
			'AW1' => 'aʊ',
			'AW2' => 'aʊ',
			'OY' => 'ɔɪ',
			'OY0' => 'ɔɪ',
			'OY1' => 'ɔɪ',
			'OY2' => 'ɔɪ',
		/*
		Consonants - Stops
		Arpabet	IPA	Word Examples
		P		p	pay (P EY1)
		B		b	buy (B AY1)
		T		t	take (T EY1 K)
		D		d	day (D EY1)
		K		k	key (K IY1)
		G		ɡ	go (G OW1)
		*/
			'P' => 'p',
			'B' => 'b',
			'T' => 't',
			'D' => 'd',
			'K' => 'k',
			'G' => 'g',
		/*
		Consonants - Affricates
		Arpabet	IPA	Word Examples
		CH		tʃ	chair (CH EH1 R)
		JH		dʒ	just (JH AH1 S T); gym (JH IH1 M)
		*/
			'CH' => 'tʃ',
			'JH' => 'dʒ',
	
		/*
		Consonants - Fricatives
		Arpabet	IPA	Word Examples
		F		f	for (F AO1 R)
		V		v	very (V EH1 R IY0)
		TH		θ	thanks (TH AE1 NG K S); Thursday (TH ER1 Z D EY2)
		DH		ð	that (DH AE1 T); the (DH AH0); them (DH EH1 M)
		S		s	say (S EY1)
		Z		z	zoo (Z UW1)
		SH		ʃ	show (SH OW1)
		ZH		ʒ	measure (M EH1 ZH ER0); pleasure (P L EH1 ZH ER)
		HH		h	house (HH AW1 S)
		*/
			'F' => 'f',
			'V' => 'v',
			'TH' => 'θ',
			'DH' => 'ð',
			'S' => 's',
			'Z' => 'z',
			'SH' => 'ʃ',
			'ZH' => 'ʒ',
			'HH' => 'h',
		/*
		Consonants - Nasals
		Arpabet	IPA	Word Examples
		M		m	man (M AE1 N)
		N		n	no (N OW1)
		NG		ŋ	sing (S IH1 NG)
		*/
			'M' => 'm',
			'N' => 'n',
			'NG' => 'ŋ',
	
		/*
		 Consonants - Liquids
		Arpabet	IPA		Word Examples
		L		ɫ OR l	late (L EY1 T)
		R		r OR ɹ	run (R AH1 N)
		*/
			'L' => 'l',
			'R' => 'r',
		/*
		 Vowels - R-colored vowels
		Arpabet			IPA	Word Examples
		ER				ɝ	her (HH ER0); bird (B ER1 D); hurt (HH ER1 T), nurse (N ER1 S)
		AXR				ɚ	father (F AA1 DH ER); coward (K AW1 ER D)
		The following R-colored vowels are contemplated above
		EH R			ɛr	air (EH1 R); where (W EH1 R); hair (HH EH1 R)
		UH R			ʊr	cure (K Y UH1 R); bureau (B Y UH1 R OW0), detour (D IH0 T UH1 R)
		AO R			ɔr	more (M AO1 R); bored (B AO1 R D); chord (K AO1 R D)
		AA R			ɑr	large (L AA1 R JH); hard (HH AA1 R D)
		IH R or IY R	ɪr	ear (IY1 R); near (N IH1 R)
		AW R			aʊr	This seems to be a rarely used r-controlled vowel. In some dialects flower (F L AW1 R; in other dialects F L AW1 ER0)
		*/
			'ER' => 'ɜr',
			'ER0' => 'ɜr',
			'ER1' => 'ɜr',
			'ER2' => 'ɜr',
			'AXR' => 'ər',
			'AXR0' => 'ər',
			'AXR1' => 'ər',
			'AXR2' => 'ər',
		/*
		Consonants - Semivowels
		Arpabet	IPA	Word Examples
		Y		j	yes (Y EH1 S)
		W		w	way (W EY1)
		*/
			'W' => 'w',
			'Y' => 'j' 
	);
	
	public function __construct() {
		
	}
	
	
	/**
	 * Use this method if you want to set a personilized convertion table
	 * @param $convertionTable = array(key=>value) 
	 * @throws \InvalidArgumentException Arpabet-to-IPA::invalid convertionTable
	 */
	public function setConvertionTable($convertionTable)
	{
		 if(isset($convertionTable) 
		 		&& !empty($convertionTable) 
		 		&& is_array($convertionTable) 
		 		&& $this->is_assoc($convertionTable)){
		 	$this->convertionTable = $convertionTable;
		 }else{
		 	throw new \InvalidArgumentException('Arpabet-to-IPA::invalid convertionTable');
		 }
	}
	
	/**
	 * It converts Arpabet to IPA, you can pass either a phoneme, or a string with many phonemes separated by space
	 * @param string $arpabetArg
	 * @throws \InvalidArgumentException Arpabet-to-IPA::arpabet phoneme cannot be null
	 * @throws \InvalidArgumentException Arpabet-to-IPA::phoneme "{arpabetPhoneme}" was not found
	 * @return Ambigous <string, NULL, multitype:string >
	 */
	public function getIPA($arpabetArg = '')
	{
		$arpabet = trim($arpabetArg);
		
		if (empty($arpabet)){
			throw new \InvalidArgumentException('Arpabet-to-IPA::arpabet phoneme cannot be null');
		}
		
		$ipaWord = '';
		$arpabetArray = preg_split('/[\s]+/',$arpabet);
		
		foreach ($arpabetArray as $arpabetPhoneme){
			$phoneme = $this->getIpaPhoneme($arpabetPhoneme);
			if(isset($phoneme)){
				$ipaWord .= $phoneme;
			}else{
            	throw new \InvalidArgumentException('Arpabet-to-IPA::phoneme "' . $arpabetPhoneme .'" was not found');
			}
		}
		return $ipaWord;
	}
	
	/**
	 * @param unknown $arpabetPhoneme
	 * @return multitype:string |NULL
	 */
	private function getIpaPhoneme($arpabetPhoneme) {
		
		if (array_key_exists($arpabetPhoneme, $this->convertionTable)){
			return $this->convertionTable[$arpabetPhoneme];
		}else{
			return NULL;
		}
	}
	
	/**
	 * @param unknown $arr
	 * @return boolean
	 */
	private function is_assoc($arr)
	{
		return array_keys($arr) !== range(0, count($arr) - 1);
	}
}
