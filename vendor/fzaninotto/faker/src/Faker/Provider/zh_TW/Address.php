<?php

namespace Faker\Provider\zh_TW;

class Address extends \Faker\Provider\Address
{
    protected static $streetNameFormats = array(
        '{{street}}{{streetSuffix}}',
        '{{street}}{{streetSuffix}}{{randomChineseNumber}}段',
    );

    protected static $streetAddressFormats = array(
        '{{streetName}}{{randomNumber3}}號',
        '{{streetName}}{{randomNumber3}}號{{randomNumber2}}樓',
        '{{streetName}}{{randomNumber3}}巷{{randomNumber3}}號',
        '{{streetName}}{{randomNumber3}}巷{{randomNumber3}}號{{randomNumber2}}樓',
        '{{streetName}}{{randomNumber3}}巷{{randomNumber3}}弄{{randomNumber3}}號',
        '{{streetName}}{{randomNumber3}}巷{{randomNumber3}}弄{{randomNumber3}}號{{randomNumber2}}樓',
    );

    protected static $secondaryAddressSuffix = array('室', '房');

    protected static $addressFormats = array(
        '{{postcode}} {{city}}{{streetAddress}}',
    );

    protected static $streetSuffix = array(
        '路', '街',
    );

    /**
     * @link http://blog.davidou.org/archives/583
     */
    protected static $street = array(
        '東英二', '大公十三', '美術南一', '漁港',
        '德美', '福林', '榮安', '忠孝南', '新立',
        '清壽', '豐偉', '華中三', '賴明', '樹仁二',
        '文萊', '凱得', '克武', '豐盛', '府前四',
        '昭德', '鳳仁', '富漁五', '炎峰街青年巷',
        '北園', '衙國一', '五和', '南村', '大埔五',
        '大有四', '太平', '瑞發', '大學二十八',
        '吉興六', '赤東一', '大學二十三', '龍德',
        '昌文', '天仁北', '賢好', '崇陽', '梅龍',
        '羅厝大坵村九江', '福鎮', '天玉', '新北一',
        '臥龍', '平生', '碇內', '衙國三', '慶豐九',
        '富漁二', '公興', '坤成', '民富十六',
        '光榮北', '赤崁東', '上麒麟',
        '公館村東平', '安船', '豐興', '三角',
        '豐裡二', '嘉豐九', '後協', '永樂南',
        '冷水', '德陽', '水汴一', '工明一',
        '環山九如', '永榮二', '清潭',
        '土地公嶺', '武淵三', '文莊', '長億東三',
        '舊城東', '大政', '玉興', '永春南',
        '國盛八', '工業區二十四', '北一', '樂群二',
        '東碇', '龍華南', '榮豐', '大豐',
        '楓江', '觀光街八連', '保興二',
        '安通二', '和順三', '彰濱東七', '麻園六',
        '上樹村北寧', '香賓街得月巷', '光平',
        '車子', '崇禮', '國慶', '阿玉', '中街',
        '同心一', '縣政十六', '德正', '濱一',
        '健行北', '大灣七', '大明', '三多五',
        '富裕三', '園南三', '安樂四', '新安七',
        '河南東四', '中坑', '明野', '秀峰', '溪心',
        '掃叭頂一', '復興南', '果峰', '新興三',
        '公安', '松智三', '國富二十八', '理想',
        '文工十二', '大竹二', '名山六', '文華一',
        '樹仁', '縣政六', '泰成', '河濱', '德吉',
        '竹林', '富台東', '東泰二', '茶專二',
        '海康', '廣安二', '軍福十八', '北文',
        '新興海埔地五', '秀隆', '福德南', '重化',
        '大安港', '東英三', '精明一', '寶強',
        '泰昌五', '立功', '文明一', '福吉一',
        '興竹', '德泉', '中正六', '工八',
        '鹽埕巷三汴', '龍天', '功安一', '炎峰',
        '路科一', '海明', '僑和', '松廉', '福豐南',
        '南園', '孝順', '富強', '保定一', '瑪鋉頂',
        '嘉興', '立德四', '中車', '陽東營區忠三',
        '福中九', '東十二', '頂湖五', '法院前',
        '西海', '士林', '北濱', '富農一', '厚北',
        '全福', '平新一', '集鹿南', '吉利六',
        '岩灣', '新基', '禾豐二', '東角', '青島一',
        '勢林街馨園一巷', '福陽', '文南一', '涵碧',
        '錦田', '國賢一', '北祥', '新成',
        '光榮東', '三鶯', '大通一', '平菁',
        '甘肅二', '古賀', '新北六', '大庄村田中',
        '四分子', '文三一', '站前街鐵路南舍',
        '新北二', '楓林十', '中北二', '北安三',
        '中華南', '光華西', '寧夏東二',
        '樹德', '八德中', '文館', '正英八',
        '大公十七', '銅科南', '長壽三', '漢翔',
        '太平十九', '宜平', '精武', '鼎金中',
        '鎮原', '明義一', '新烏', '蘭洲街三疊溪',
        '六家八', '南勢坑', '工業東六', '四平',
        '甘肅', '永康', '雙十',
        '大地', '中陽東', '立華', '維揚', '太原三',
        '水源', '重立', '民主四', '南福',
        '鎮國', '永勝', '新華', '柯林新', '南橋一',
        '大公十四', '勝利七', '三和二',
        '東庄', '文匯', '中新一', '松信一',
        '寶君', '平安南', '文學', '大華五',
        '行義', '百五', '草衙中', '嘉祥五',
        '平等', '光美', '成功十六', '精誠三',
        '水美', '文化十', '民權東', '大慶',
        '源泉', '文成北', '大坪五', '光華六',
        '玉清二', '龍鳳', '上山二', '西十四',
        '文康', '崇德十二', '天泉一', '新庄',
        '芝麻五', '中山西', '長春', '中一',
        '八張二', '嘉安八', '成德九', '三村',
        '忠孝東', '遼北', '徐州一', '徐州五',
        '六張', '中西', '大平', '順興', '新展',
        '南澳南', '吉利四', '久安二', '斗六五',
        '登山', '貴林', '桐竹', '社斗',
        '中樂', '山湖二', '長園二', '埤尾', '應化',
        '水碓二', '嶺頂九分', '中和', '幸福五',
        '長安東', '愛富二街厚生巷', '崇德三',
        '甲樹', '篤信', '金龍二', '為隨東',
        '明鳳五', '草湖村仁愛', '至平', '惟馨',
        '濃公', '錫安', '中庄東', '保順',
        '龍橋', '文二三', '通明', '東信',
        '秀福', '光榮', '棒球三', '立達',
        '長樂五', '永安', '瀋陽', '文宏一',
        '斗苑', '新興二', '新五', '科雅六',
        '青埔八', '永安東', '行忠', '梅亭東',
        '保榮', '國富二十六', '自強九', '學進',
        '線東', '中興二', '柯林七', '國盛三',
        '平安', '重建', '臥龍', '松文', '花秀',
        '太原四', '北門', '新生三', '花旗',
        '大源十九', '光華十', '內江', '埔興',
        '芝柏一', '府中', '乾興', '華廈', '長埤',
        '新富', '山明', '城中五', '富裕十七',
        '修明', '贊庄大仁', '三和', '科大一',
        '光州一', '平等十二', '新寮一', '東林東',
        '永新二', '頂橫', '東門', '石園', '寶深',
        '長青', '金鋒一', '福壽', '連雲',
        '自立二', '北辰一', '松三', '嘉朴',
        '鎮新二', '莊敬', '中興十', '忠明七',
        '福興八', '中心', '海口北', '工業三',
        '大弘一', '親民', '芳樂', '赤崁南', '文開',
        '五權西', '新興海埔地三', '華泰一',
        '文澄', '中山西', '崇德二十九',
        '內定七', '新基北', '南澳', '尚德',
        '後港一', '西建', '力行五', '中央七',
        '苓安', '裕隆', '布西', '鹽田',
        '建國南', '順興', '朝奉', '賜安',
        '崇德十八', '頂庄', '福營', '工業二十',
        '徐州四', '鼎愛', '香檳二', '竹社',
        '惠中一', '重仁', '德福', '同源',
        '下莊新生', '廣明', '明仁一', '中正東',
        '鳳尾', '濟南', '復華四', '新基南',
        '潭工一', '學三', '龍善二', '六路七',
        '環美', '建興三', '福錦', '永義九',
        '和祥七', '漁港中一', '樹林六', '東信',
        '壽福', '鳳楠', '五福六', '大源二十',
        '南勢十', '中港三', '小坑', '勝利十五',
        '老吸', '鎮新五', '名水', '蘇港',
        '櫻城三', '裕孝三', '稻香五', '豐源',
        '大功', '陜西',
    );

    /**
     * @link http://zh.wikipedia.org/wiki/%E8%87%BA%E7%81%A3%E8%A1%8C%E6%94%BF%E5%8D%80%E5%8A%83
     */
    protected static $city = array(
        '新北市' => array(
            '板橋區', '三重區', '中和區', '永和區',
            '新莊區', '新店區', '樹林區', '鶯歌區',
            '三峽區', '淡水區', '汐止區', '瑞芳區',
            '土城區', '蘆洲區', '五股區', '泰山區',
            '林口區', '深坑區', '石碇區', '坪林區',
            '三芝區', '石門區', '八里區', '平溪區',
            '雙溪區', '貢寮區', '金山區', '萬里區',
            '烏來區',
        ),
        '宜蘭縣' => array(
            '宜蘭市', '羅東鎮', '蘇澳鎮', '頭城鎮', '礁溪鄉',
            '壯圍鄉', '員山鄉', '冬山鄉', '五結鄉', '三星鄉',
            '大同鄉', '南澳鄉',
        ),
        '桃園縣' => array(
            '桃園市', '中壢市', '大溪鎮', '楊梅鎮', '蘆竹鄉',
            '大園鄉', '龜山鄉', '八德市', '龍潭鄉', '平鎮市',
            '新屋鄉', '觀音鄉', '復興鄉',
        ),
        '新竹縣' => array(
            '竹北市', '竹東鎮', '新埔鎮', '關西鎮', '湖口鄉',
            '新豐鄉', '芎林鄉', '橫山鄉', '北埔鄉', '寶山鄉',
            '峨眉鄉', '尖石鄉', '五峰鄉',
        ),
        '苗栗縣' => array(
            '苗栗市', '苑裡鎮', '通霄鎮', '竹南鎮', '頭份鎮',
            '後龍鎮', '卓蘭鎮', '大湖鄉', '公館鄉', '銅鑼鄉',
            '南庄鄉', '頭屋鄉', '三義鄉', '西湖鄉', '造橋鄉',
            '三灣鄉', '獅潭鄉', '泰安鄉',
        ),
        '臺中市' => array(
            '豐原區', '東勢區', '大甲區', '清水區', '沙鹿區',
            '梧棲區', '后里區', '神岡區', '潭子區', '大雅區',
            '新社區', '石岡區', '外埔區', '大安區', '烏日區',
            '大肚區', '龍井區', '霧峰區', '太平區', '大里區',
            '和平區', '中區', '東區', '南區', '西區', '北區',
            '西屯區', '南屯區', '北屯區',
        ),
        '彰化縣' => array(
            '彰化市', '鹿港鎮', '和美鎮', '線西鄉', '伸港鄉',
            '福興鄉', '秀水鄉', '花壇鄉', '芬園鄉', '員林鎮',
            '溪湖鎮', '田中鎮', '大村鄉', '埔鹽鄉', '埔心鄉',
            '永靖鄉', '社頭鄉', '二水鄉', '北斗鎮', '二林鎮',
            '田尾鄉', '埤頭鄉', '芳苑鄉', '大城鄉', '竹塘鄉',
            '溪州鄉',
        ),
        '南投縣' => array(
            '南投市', '埔里鎮', '草屯鎮', '竹山鎮', '集集鎮',
            '名間鄉', '鹿谷鄉', '中寮鄉', '魚池鄉', '國姓鄉',
            '水里鄉', '信義鄉', '仁愛鄉',
        ),
        '雲林縣' => array(
            '斗六市', '斗南鎮', '虎尾鎮', '西螺鎮', '土庫鎮',
            '北港鎮', '古坑鄉', '大埤鄉', '莿桐鄉', '林內鄉',
            '二崙鄉', '崙背鄉', '麥寮鄉', '東勢鄉', '褒忠鄉',
            '臺西鄉', '元長鄉', '四湖鄉', '口湖鄉', '水林鄉',
        ),
        '嘉義縣' => array(
            '太保市', '朴子市', '布袋鎮', '大林鎮', '民雄鄉',
            '溪口鄉', '新港鄉', '六腳鄉', '東石鄉', '義竹鄉',
            '鹿草鄉', '水上鄉', '中埔鄉', '竹崎鄉', '梅山鄉',
            '番路鄉', '大埔鄉', '阿里山鄉',
        ),
        '臺南市' => array(
            '新營區', '鹽水區', '白河區', '柳營區', '後壁區',
            '東山區', '麻豆區', '下營區', '六甲區', '官田區',
            '大內區', '佳里區', '學甲區', '西港區', '七股區',
            '將軍區', '北門區', '新化區', '善化區', '新市區',
            '安定區', '山上區', '玉井區', '楠西區', '南化區',
            '左鎮區', '仁德區', '歸仁區', '關廟區', '龍崎區',
            '永康區', '東區', '南區', '西區', '北區', '中區',
            '安南區', '安平區',
        ),
        '高雄市' => array(
            '鳳山區', '林園區', '大寮區', '大樹區', '大社區',
            '仁武區', '鳥松區', '岡山區', '橋頭區', '燕巢區',
            '田寮區', '阿蓮區', '路竹區', '湖內區', '茄萣區',
            '永安區', '彌陀區', '梓官區', '旗山區', '美濃區',
            '六龜區', '甲仙區', '杉林區', '內門區', '茂林區',
            '桃源區', '三民區', '鹽埕區', '鼓山區', '左營區',
            '楠梓區', '三民區', '新興區', '前金區', '苓雅區',
            '前鎮區', '旗津區', '小港區',
        ),
        '屏東縣' => array(
            '屏東市', '潮州鎮', '東港鎮', '恆春鎮', '萬丹鄉',
            '長治鄉', '麟洛鄉', '九如鄉', '里港鄉', '鹽埔鄉',
            '高樹鄉', '萬巒鄉', '內埔鄉', '竹田鄉', '新埤鄉',
            '枋寮鄉', '新園鄉', '崁頂鄉', '林邊鄉', '南州鄉',
            '佳冬鄉', '琉球鄉', '車城鄉', '滿州鄉', '枋山鄉',
            '三地門鄉', '霧臺鄉', '瑪家鄉', '泰武鄉', '來義鄉',
            '春日鄉', '獅子鄉', '牡丹鄉',
        ),
        '臺東縣' => array(
            '臺東市', '成功鎮', '關山鎮', '卑南鄉', '鹿野鄉',
            '池上鄉', '東河鄉', '長濱鄉', '太麻里鄉', '大武鄉',
            '綠島鄉', '海端鄉', '延平鄉', '金峰鄉', '達仁鄉',
            '蘭嶼鄉',
        ),
        '花蓮縣' => array(
            '花蓮市', '鳳林鎮', '玉里鎮', '新城鄉', '吉安鄉',
            '壽豐鄉', '光復鄉', '豐濱鄉', '瑞穗鄉', '富里鄉',
            '秀林鄉', '萬榮鄉', '卓溪鄉',
        ),
        '澎湖縣' => array(
            '馬公市', '湖西鄉', '白沙鄉', '西嶼鄉', '望安鄉',
            '七美鄉',
        ),
        '基隆市' => array(
            '中正區', '七堵區', '暖暖區', '仁愛區', '中山區',
            '安樂區', '信義區',
        ),
        '新竹市' => array(
            '東區', '北區', '香山區',
        ),
        '嘉義市' => array(
            '東區', '西區',
        ),
        '臺北市' => array(
            '松山區', '信義區', '大安區', '中山區', '中正區',
            '大同區', '萬華區', '文山區', '南港區', '內湖區',
            '士林區', '北投區',
        ),
        '連江縣' => array(
            '南竿鄉', '北竿鄉', '莒光鄉', '東引鄉',
        ),
        '金門縣' => array(
            '金城鎮', '金沙鎮', '金湖鎮', '金寧鄉', '烈嶼鄉', '烏坵鄉',
        ),
    );

    /**
     * @link http://terms.naer.edu.tw/download/287/
     */
    protected static $country = array(
        '不丹', '中非', '丹麥', '伊朗', '冰島', '剛果',
        '加彭', '北韓', '南非', '卡達', '印尼', '印度',
        '古巴', '哥德', '埃及', '多哥', '寮國', '尼日',
        '巴曼', '巴林', '巴紐', '巴西', '希臘', '帛琉',
        '德國', '挪威', '捷克', '教廷', '斐濟', '日本',
        '智利', '東加', '查德', '汶萊', '法國', '波蘭',
        '波赫', '泰國', '海地', '瑞典', '瑞士', '祕魯',
        '秘魯', '約旦', '紐埃', '緬甸', '美國', '聖尼',
        '聖普', '肯亞', '芬蘭', '英國', '荷蘭', '葉門',
        '蘇丹', '諾魯', '貝南', '越南', '迦彭',
        '迦納', '阿曼', '阿聯', '韓國', '馬利',
        '以色列', '以色利', '伊拉克', '俄羅斯',
        '利比亞', '加拿大', '匈牙利', '南極洲',
        '南蘇丹', '厄瓜多', '吉布地', '吐瓦魯',
        '哈撒克', '哈薩克', '喀麥隆', '喬治亞',
        '土庫曼', '土耳其', '塔吉克', '塞席爾',
        '墨西哥', '大西洋', '奧地利', '孟加拉',
        '安哥拉', '安地卡', '安道爾', '尚比亞',
        '尼伯爾', '尼泊爾', '巴哈馬', '巴拉圭',
        '巴拿馬', '巴貝多', '幾內亞', '愛爾蘭',
        '所在國', '摩洛哥', '摩納哥', '敍利亞',
        '敘利亞', '新加坡', '東帝汶', '柬埔寨',
        '比利時', '波扎那', '波札那', '烏克蘭',
        '烏干達', '烏拉圭', '牙買加', '獅子山',
        '甘比亞', '盧安達', '盧森堡', '科威特',
        '科索夫', '科索沃', '立陶宛', '紐西蘭',
        '維德角', '義大利', '聖文森', '艾塞亞',
        '菲律賓', '萬那杜', '葡萄牙', '蒲隆地',
        '蓋亞納', '薩摩亞', '蘇利南', '西班牙',
        '貝里斯', '賴索托', '辛巴威', '阿富汗',
        '阿根廷', '馬其頓', '馬拉威', '馬爾他',
        '黎巴嫩', '亞塞拜然', '亞美尼亞', '保加利亞',
        '南斯拉夫', '厄利垂亞', '史瓦濟蘭', '吉爾吉斯',
        '吉里巴斯', '哥倫比亞', '坦尚尼亞', '塞內加爾',
        '塞内加爾', '塞爾維亞', '多明尼加', '多米尼克',
        '奈及利亞', '委內瑞拉', '宏都拉斯', '尼加拉瓜',
        '巴基斯坦', '庫克群島', '愛沙尼亞', '拉脫維亞',
        '摩爾多瓦', '摩里西斯', '斯洛伐克', '斯里蘭卡',
        '格瑞那達', '模里西斯', '波多黎各', '澳大利亞',
        '烏茲別克', '玻利維亞', '瓜地馬拉', '白俄羅斯',
        '突尼西亞', '納米比亞', '索馬利亞', '索馬尼亞',
        '羅馬尼亞', '聖露西亞', '聖馬利諾', '莫三比克',
        '莫三鼻克', '葛摩聯盟', '薩爾瓦多', '衣索比亞',
        '西薩摩亞', '象牙海岸', '賴比瑞亞', '賽普勒斯',
        '馬來西亞', '馬爾地夫', '克羅埃西亞',
        '列支敦斯登', '哥斯大黎加', '布吉納法索',
        '布吉那法索', '幾內亞比索', '幾內亞比紹',
        '斯洛維尼亞', '索羅門群島', '茅利塔尼亞',
        '蒙特內哥羅', '赤道幾內亞', '阿爾及利亞',
        '阿爾及尼亞', '阿爾巴尼亞', '馬紹爾群島',
        '馬達加斯加', '密克羅尼西亞', '沙烏地阿拉伯',
        '千里達及托巴哥',
    );

    protected static $postcode = array('###-##', '###');

    public function street()
    {
        return static::randomElement(static::$street);
    }

    public static function randomChineseNumber()
    {
        $digits = array(
            '', '一', '二', '三', '四', '五', '六', '七', '八', '九',
        );
        return $digits[static::randomDigitNotNull()];
    }

    public static function randomNumber2()
    {
        return static::randomNumber(2) + 1;
    }

    public static function randomNumber3()
    {
        return static::randomNumber(3) + 1;
    }

    public static function localLatitude()
    {
        return number_format(mt_rand(22000000, 25000000)/1000000, 6);
    }

    public static function localLongitude()
    {
        return number_format(mt_rand(120000000, 122000000)/1000000, 6);
    }

    public function city()
    {
        $county = static::randomElement(array_keys(static::$city));
        $city = static::randomElement(static::$city[$county]);
        return $county.$city;
    }

    public function state()
    {
        return '臺灣省';
    }

    public static function stateAbbr()
    {
        return '臺';
    }

    public static function cityPrefix()
    {
        return '';
    }

    public static function citySuffix()
    {
        return '';
    }

    public static function secondaryAddress()
    {
        return (static::randomNumber(2)+1).static::randomElement(static::$secondaryAddressSuffix);
    }
}
