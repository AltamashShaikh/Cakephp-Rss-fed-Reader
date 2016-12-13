<?php

App::uses('Xml', 'Utility');

class RssComponent extends Component {

    /**
     * Reads an (external) RSS feed and returns it's items.
     *
     * @param $feed - The URL to the feed.
     * @param int $items - The amount of items to read.
     * @return array
     * @throws InternalErrorException
     */
    public function read($feed, $items = 10) {
        try {
            // Try to read the given RSS feed
            $xmlObject = Xml::build($feed);
        } catch (XmlException $e) {
            // Reading XML failed, throw InternalErrorException
            throw new InternalErrorException();
        }

        $output = array();
//        pr($xmlObject->entry['1']);
//        die;
        for ($i = 0; $i < $items; $i++) {
            if (isset($xmlObject->channel->item->$i) && is_object($xmlObject->channel->item->$i)) {
                $output[] = $xmlObject->channel->item->$i;
            } else if (isset($xmlObject->entry[$i]) && is_object($xmlObject->entry[$i])) {
                $link=((array) $xmlObject->entry[$i]->link);
                $array_format=(array)$xmlObject->entry[$i];
                $tmp_object = new stdClass();
                $tmp_object->title=$array_format['title'];
                $tmp_object->pubDate=$array_format['updated'];
                $tmp_object->description=$array_format['content'];
                $tmp_object->link=$link['@attributes']['href'];
                $output[] = $tmp_object;
            }
        }

        return $output;
    }

}
