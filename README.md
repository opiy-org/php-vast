PHP-VAST
========

forked from sokil/vast (https://github.com/sokil/php-vast.git)

VAST Ad generator and parser library on PHP.

## Specs
* VAST 2.0 Spec: http://www.iab.net/media/file/VAST-2_0-FINAL.pdf
* VAST 3.0 Spec: http://www.iab.com/wp-content/uploads/2015/06/VASTv3_0.pdf
* VAST 4.0 Spec: 
  * http://www.iab.com/wp-content/uploads/2016/01/VAST_4-0_2016-01-21.pdf
  * https://www.iab.com/wp-content/uploads/2016/04/VAST4.0_Updated_April_2016.pdf
* [VAST Samples](https://github.com/InteractiveAdvertisingBureau/VAST_Samples)

## Install

Install library through composer:

```
composer require sokil/php-vast
```

## Quick start

```php
// create document
$factory = new \Sokil\Vast\Factory();
$document = $factory->create('2.0');
// or, if you have at least PHP5.4
$document = (new \Sokil\Vast\Factory())->create('2.0');
// creating through Document::create and other factory methods are now deprecated:
$document = \Sokil\Vast\Document::create('2.0');

// insert Ad section
$ad1 = $document
    ->createInLineAdSection()
    ->setId('ad1')
    ->setAdSystem('Ad Server Name')
    ->setAdTitle('Ad Title')
    ->addImpression('http://ad.server.com/impression', 'imp1');

// create creative for ad section
$linearCreative = $ad1
    ->createLinearCreative()
    ->setDuration(128)
    ->setVideoClicksClickThrough('http://entertainmentserver.com/landing')
    ->addVideoClicksClickTracking('http://ad.server.com/videoclicks/clicktracking')
    ->addVideoClicksCustomClick('http://ad.server.com/videoclicks/customclick')
    ->addTrackingEvent('start', 'http://ad.server.com/trackingevent/start')
    ->addTrackingEvent('pause', 'http://ad.server.com/trackingevent/stop');
    
// add 100x100 media file
$linearCreative
    ->createMediaFile()
    ->setProgressiveDelivery()
    ->setType('video/mp4')
    ->setHeight(100)
    ->setWidth(100)
    ->setBitrate(2500)
    ->setUrl('http://server.com/media1.mp4');

// add 200x200 media file
$linearCreative
    ->createMediaFile()
    ->setProgressiveDelivery()
    ->setType('video/mp4')
    ->setHeight(200)
    ->setWidth(200)
    ->setBitrate(2500)
    ->setUrl('http://server.com/media2.mp4');
    
// get dom document
$domDocument = $document->toDomDocument();

// get XML string
echo $document;
```

This will generate:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<VAST version="2.0">
    <Ad id="ad1">
        <InLine>
            <AdSystem>Ad Server Name</AdSystem>
            <AdTitle><![CDATA[Ad Title]]></AdTitle>
            <Impression id="imp1"><![CDATA[http://ad.server.com/impression]]></Impression>
            <Creatives>
                <Creative>
                    <Linear>
                        <Duration>00:02:08</Duration>
                        <VideoClicks>
                            <ClickThrough><![CDATA[http://entertainmentserver.com/landing]]></ClickThrough>
                            <ClickTracking><![CDATA[http://ad.server.com/videoclicks/clicktracking]]></ClickTracking>
                            <CustomClick><![CDATA[http://ad.server.com/videoclicks/customclick]]></CustomClick>
                        </VideoClicks>
                        <TrackingEvents>
                            <Tracking event="start"><![CDATA[http://ad.server.com/trackingevent/start]]></Tracking>
                            <Tracking event="pause"><![CDATA[http://ad.server.com/trackingevent/stop]]></Tracking>
                        </TrackingEvents>
                        <MediaFiles>
                            <MediaFile delivery="progressive" type="video/mp4" height="100" width="100" bitrate="2500">
                                <![CDATA[http://server.com/media1.mp4]]>
                            </MediaFile>
                            <MediaFile delivery="progressive" type="video/mp4" height="200" width="200" bitrate="2500">
                                <![CDATA[http://server.com/media2.mp4]]>
                            </MediaFile>
                        </MediaFiles>
                    </Linear>
                </Creative>
            </Creatives>
        </InLine>
    </Ad>
</VAST>
```
