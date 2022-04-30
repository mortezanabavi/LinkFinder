<?php
error_reporting(0);


if (!file_exists('Link.json')) {
	file_put_contents('Link.json',json_encode(['Hash' => []]));
}

if(!isset($_GET['id'])) {
	$_GET['id'] = ['Mylinkgp','linkdony_links_Linkestan_linkk','linksarayiirani','Urmiya_link','linkestanARYAEI','linkestan_0','Kurdistan_linkdonii','linkdonikurdiiii','linkdoni_kade','linkdooni_yasi','linkdoni7703','linkdonie00','grouhkadeh','linkdoni','linkdoni1','LinkGp','Link4you','gorohkadetel','linkshomalia','Gay_Link0s'];
}
else {
	$_GET['id'] = explode(',',$_GET['id']);
}

class Hash{
    public function Open_URL($url){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return curl_exec($ch);
    }
    public function gethash($channel){
        $get = $this->Open_URL('https://t.me/s/' . str_replace('@',null,$channel));
        preg_match_all('#<a href="https://t.me/joinchat/(.*?)" target="_blank" rel="noopener">https://t.me/joinchat/(.*?)</a>#', $get, $proxies);
        return $proxies;
    }
    public function check($hash){
        $url = $this->Open_URL('https://t.me/joinchat/' . $hash);
        $type = explode('<',explode('">Join ',$url)[1])[0];
        return $type;
    }
    public function status($hash){
        $url = $this->Open_URL('https://t.me/joinchat/'  . $hash);
        $member = explode('<div class="tgme_page_extra">',$url)[1];
        $online = explode('members,',$member)[1];
        $online = explode(' online',$online)[0];
        $online = str_replace(' ',null,$online);
        $member = explode('members,',$member)[0];
        $member = str_replace(' ',null,$member);
        return ['member' => $member, 'online' => $online];
    }
}
foreach($_GET['id'] as $id) {
    $Hash = new Hash();
    $hashhaa = $Hash->gethash($id)[1];
    foreach($hashhaa as $hash) {
        $hash = trim($hash);
        $Link = json_decode(file_get_contents('Link.json'),true);
        if (!in_array($hash,$Link['Hash'])) {
            if (trim($Hash->check($hash)) == 'Group') {
                $Link['Hash'][] = $hash;
				file_put_contents('Link.json',json_encode($Link));
            }
        }
    }
}

echo 'Done! Channel : @DaieTeam';