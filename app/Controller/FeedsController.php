<?php

App::uses('Xml', 'Utility');

class FeedsController extends AppController {

    public $components = array('Rss');

    function index() {
        $this->view='index';
        try {
            $feed_url='https://www.reddit.com/.rss';
            $count=10;
            $request_query=$this->request->query;
            if(isset($request_query['feed_url']) && !empty($request_query['feed_url'])){
                $feed_url=$request_query['feed_url'];
            }
            if(isset($request_query['size']) && !empty($request_query['size']) && is_numeric($request_query['size'])){
                $count=$request_query['size'];
            }
            $newsItems = $this->Rss->read($feed_url,$count);
            
//            $xml = Xml::build('https://www.reddit.com/.rss', array('return' => 'domdocument'));
//        $xml = Xml::build('http://news.google.com/news?ned=us&topic=h&output=rss', array('return' => 'domdocument'));
//        $xml = Xml::build('http://rss.msnbc.msn.com/id/3032091/device/rss/rss.xml', array('return' => 'domdocument'));
//        $xml = Xml::build('http://kurinchilamp.kurinchilion.com/feed', array('return' => 'domdocument'));
        } catch (InternalErrorException $e) {
            $newsItems = null;
        }

        $this->set('news', $newsItems);
        $this->set('feed_url', $feed_url);
    }


}
