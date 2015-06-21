<h1>Arpabet-to-IPA</h1>
Arpabet-to-IPA converts Arpabet to IPA.<br/>
<a href='https://en.wikipedia.org/wiki/Arpabet'>Arpabet</a> is the set of phonemes used by <a href='http://www.speech.cs.cmu.edu/cgi-bin/cmudict'>cmudict</a>, which is The CMU Pronouncing Dictionary. <a href='https://en.wikipedia.org/wiki/IPA'>IPA</a> is the International Phonetic Alphabet.

<h2>Getting Started</h2>

<h3>Install</h3>
<p>You may install the Arpabet-to-IPA with Composer (recommended) or manually.</p>
<p>Installing Arpabet-to-IPA:</p>
<pre><code>composer require wwesantos/arpabet-to-ipa</code></pre>

<h3>Tutorial</h3>
<p>Instantiate and use a Arpabet-to-IPA class:</p>
<pre><code>
  		$arpabetToIPA = new ArpabetToIPA\App();
		  $ipaPhoneme = $arpabetToIPA-&gt;getIPA('AA');
		  $ipaWord = $arpabetToIPA-&gt;getIPA('F OW1 N IY0 M');
</code></pre>

<p>You may define your own convertion table</p>
<pre><code>
  		$arpabetToIPA-&gt;setConvertionTable(array(
				'AO' => 'ɔ',
				'AA' => 'ɑ',
				'F' => 'f',
				'V' => 'v',
				'S' => 's'
		));
</code>
</pre>

<h3>System Requirements</h3>
<p>You need <strong>PHP &gt;= 5.3.0</strong>.</p>

<h2>License</h2>
<p>The Arpabet-to-IPA is released under the MIT public license.</p>
<a href="https://github.com/wwesantos/arpabet-to-ipa/blob/master/LICENSE">https://github.com/wwesantos/arpabet-to-ipa/blob/master/LICENSE</a>
