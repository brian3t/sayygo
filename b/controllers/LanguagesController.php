<?php

namespace backend\controllers;

use Yii;
use backend\models\Languages;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KeywordController implements the CRUD actions for Keyword model.
 */
class LanguagesController extends Controller {
	/*
* Return models' data in json format
*/
	public function actionGet( $search = null, $id= null ) {
		if ( empty($id) || $id === " ") {
			return '{"results":[{"id":"aa","text":"Afar"},{"id":"ab","text":"Abkhaz"},{"id":"ae","text":"Avestan"},{"id":"af","text":"Afrikaans"},{"id":"ak","text":"Akan"},{"id":"am","text":"Amharic"},{"id":"an","text":"Aragonese"},{"id":"ar","text":"Arabic"},{"id":"as","text":"Assamese"},{"id":"av","text":"Avaric"},{"id":"ay","text":"Aymara"},{"id":"az","text":"Azerbaijani"},{"id":"ba","text":"Bashkir"},{"id":"be","text":"Belarusian"},{"id":"bg","text":"Bulgarian"},{"id":"bh","text":"Bihari"},{"id":"bi","text":"Bislama"},{"id":"bm","text":"Bambara"},{"id":"bn","text":"Bengali"},{"id":"bo","text":"Tibetan Standard, Tibetan, Central"},{"id":"br","text":"Breton"},{"id":"bs","text":"Bosnian"},{"id":"ca","text":"Catalan; Valencian"},{"id":"ce","text":"Chechen"},{"id":"ch","text":"Chamorro"},{"id":"co","text":"Corsican"},{"id":"cr","text":"Cree"},{"id":"cs","text":"Czech"},{"id":"cu","text":"Old Church Slavonic, Church Slavic, Church Slavonic, Old Bulgarian, Old Slavonic"},{"id":"cv","text":"Chuvash"},{"id":"cy","text":"Welsh"},{"id":"da","text":"Danish"},{"id":"de","text":"German"},{"id":"dv","text":"Divehi; Dhivehi; Maldivian;"},{"id":"dz","text":"Dzongkha"},{"id":"ee","text":"Ewe"},{"id":"el","text":"Greek, Modern"},{"id":"en","text":"English"},{"id":"eo","text":"Esperanto"},{"id":"es","text":"Spanish; Castilian"},{"id":"et","text":"Estonian"},{"id":"eu","text":"Basque"},{"id":"fa","text":"Persian"},{"id":"ff","text":"Fula; Fulah; Pulaar; Pular"},{"id":"fi","text":"Finnish"},{"id":"fj","text":"Fijian"},{"id":"fo","text":"Faroese"},{"id":"fr","text":"French"},{"id":"fy","text":"Western Frisian"},{"id":"ga","text":"Irish"},{"id":"gd","text":"Scottish Gaelic; Gaelic"},{"id":"gl","text":"Galician"},{"id":"gn","text":"Guaran\u00c3\u00ad"},{"id":"gu","text":"Gujarati"},{"id":"gv","text":"Manx"},{"id":"ha","text":"Hausa"},{"id":"he","text":"Hebrew (modern)"},{"id":"hi","text":"Hindi"},{"id":"ho","text":"Hiri Motu"},{"id":"hr","text":"Croatian"},{"id":"ht","text":"Haitian; Haitian Creole"},{"id":"hu","text":"Hungarian"},{"id":"hy","text":"Armenian"},{"id":"hz","text":"Herero"},{"id":"ia","text":"Interlingua"},{"id":"id","text":"Indonesian"},{"id":"ie","text":"Interlingue"},{"id":"ig","text":"Igbo"},{"id":"ii","text":"Nuosu"},{"id":"ik","text":"Inupiaq"},{"id":"io","text":"Ido"},{"id":"is","text":"Icelandic"},{"id":"it","text":"Italian"},{"id":"iu","text":"Inuktitut"},{"id":"ja","text":"Japanese (ja)"},{"id":"jv","text":"Javanese (jv)"},{"id":"ka","text":"Georgian"},{"id":"kg","text":"Kongo"},{"id":"ki","text":"Kikuyu, Gikuyu"},{"id":"kj","text":"Kwanyama, Kuanyama"},{"id":"kk","text":"Kazakh"},{"id":"kl","text":"Kalaallisut, Greenlandic"},{"id":"km","text":"Khmer"},{"id":"kn","text":"Kannada"},{"id":"ko","text":"Korean"},{"id":"kr","text":"Kanuri"},{"id":"ks","text":"Kashmiri"},{"id":"ku","text":"Kurdish"},{"id":"kv","text":"Komi"},{"id":"kw","text":"Cornish"},{"id":"ky","text":"Kirghiz, Kyrgyz"},{"id":"la","text":"Latin"},{"id":"lb","text":"Luxembourgish, Letzeburgesch"},{"id":"lg","text":"Luganda"},{"id":"li","text":"Limburgish, Limburgan, Limburger"},{"id":"ln","text":"Lingala"},{"id":"lo","text":"Lao"},{"id":"lt","text":"Lithuanian"},{"id":"lu","text":"Luba-Katanga"},{"id":"lv","text":"Latvian"},{"id":"mg","text":"Malagasy"},{"id":"mh","text":"Marshallese"},{"id":"mi","text":"Maori"},{"id":"mk","text":"Macedonian"},{"id":"ml","text":"Malayalam"},{"id":"mn","text":"Mongolian"},{"id":"mr","text":"Marathi (Mara?hi)"},{"id":"ms","text":"Malay"},{"id":"mt","text":"Maltese"},{"id":"my","text":"Burmese"},{"id":"na","text":"Nauru"},{"id":"nb","text":"Norwegian Bokm\u00c3\u00a5l"},{"id":"nd","text":"North Ndebele"},{"id":"ne","text":"Nepali"},{"id":"ng","text":"Ndonga"},{"id":"nl","text":"Dutch"},{"id":"nn","text":"Norwegian Nynorsk"},{"id":"no","text":"Norwegian"},{"id":"nr","text":"South Ndebele"},{"id":"nv","text":"Navajo, Navaho"},{"id":"ny","text":"Chichewa; Chewa; Nyanja"},{"id":"oc","text":"Occitan"},{"id":"oj","text":"Ojibwe, Ojibwa"},{"id":"om","text":"Oromo"},{"id":"or","text":"Oriya"},{"id":"os","text":"Ossetian, Ossetic"},{"id":"pa","text":"Panjabi, Punjabi"},{"id":"pi","text":"Pali"},{"id":"pl","text":"Polish"},{"id":"ps","text":"Pashto, Pushto"},{"id":"pt","text":"Portuguese"},{"id":"qu","text":"Quechua"},{"id":"rm","text":"Romansh"},{"id":"rn","text":"Kirundi"},{"id":"ro","text":"Romanian, Moldavian, Moldovan"},{"id":"ru","text":"Russian"},{"id":"rw","text":"Kinyarwanda"},{"id":"sa","text":"Sanskrit (Sa?sk?ta)"},{"id":"sc","text":"Sardinian"},{"id":"sd","text":"Sindhi"},{"id":"se","text":"Northern Sami"},{"id":"sg","text":"Sango"},{"id":"si","text":"Sinhala, Sinhalese"},{"id":"sk","text":"Slovak"},{"id":"sl","text":"Slovene"},{"id":"sm","text":"Samoan"},{"id":"sn","text":"Shona"},{"id":"so","text":"Somali"},{"id":"sq","text":"Albanian"},{"id":"sr","text":"Serbian"},{"id":"ss","text":"Swati"},{"id":"st","text":"Southern Sotho"},{"id":"su","text":"Sundanese"},{"id":"sv","text":"Swedish"},{"id":"sw","text":"Swahili"},{"id":"ta","text":"Tamil"},{"id":"te","text":"Telugu"},{"id":"tg","text":"Tajik"},{"id":"th","text":"Thai"},{"id":"ti","text":"Tigrinya"},{"id":"tk","text":"Turkmen"},{"id":"tl","text":"Tagalog"},{"id":"tn","text":"Tswana"},{"id":"to","text":"Tonga (Tonga Islands)"},{"id":"tr","text":"Turkish"},{"id":"ts","text":"Tsonga"},{"id":"tt","text":"Tatar"},{"id":"tw","text":"Twi"},{"id":"ty","text":"Tahitian"},{"id":"ug","text":"Uighur, Uyghur"},{"id":"uk","text":"Ukrainian"},{"id":"ur","text":"Urdu"},{"id":"uz","text":"Uzbek"},{"id":"ve","text":"Venda"},{"id":"vi","text":"Vietnamese"},{"id":"vo","text":"Volap\u00c3\u00bck"},{"id":"wa","text":"Walloon"},{"id":"wo","text":"Wolof"},{"id":"xh","text":"Xhosa"},{"id":"yi","text":"Yiddish"},{"id":"yo","text":"Yoruba"},{"id":"za","text":"Zhuang, Chuang"},{"id":"zh","text":"Chinese"},{"id":"zu","text":"Zulu"}]}';
		}
		$searchResult = [];
		$LANGUAGES = Languages::$data;
		$LANGUAGES_FLIPPED = ($LANGUAGES);
		$searchResult = array_filter($LANGUAGES_FLIPPED, function($e) use ($id){return (stripos($e,$id) > -1);});
		$searchResult = ($searchResult);
		$searchResultSelect2 = [];
		foreach ($searchResult as $k=>$v){
			array_push($searchResultSelect2,['id'=>$k, 'text' => $v]);
		}
		return json_encode(['results' => $searchResultSelect2]);
	}

}
