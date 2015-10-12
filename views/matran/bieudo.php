<?php
/* @var $this yii\web\View */
$this->title = 'Biểu đồ';
?>
<link rel="stylesheet" type="text/css" href="/css/webvowl.css"/>
<link rel="stylesheet" type="text/css" href="/css/webvowl.app.css"/>
<section id="canvasArea">
        <div id="logo">
                <!-- build:process --><h4></h4><!-- /build -->
        </div>
        <div id="loading-info">
                <div id="loading-error" class="hidden">
                        <div id="error-info"></div>
                        <div id="error-description-button" class="hidden">Show error details</div>
                        <div id="error-description-container" class="hidden">
                                <pre id="error-description"></pre>
                        </div>
                </div>
                <div id="loading-progress" class="hidden">
                        <span>Loading ontology... </span><div class="spin">&#8635;</div>
                </div>
        </div>
    <div id="graph">


    </div>
</section>
<aside id="detailsArea">
        <section id="generalDetails">
                <h3  id="selection-details-trigger"  >
                </h3>

        </section>
</aside>
<nav id="optionsArea">
        <ul id="optionsMenu">
                
                <li id="pauseOption"><a id="pause-button" href="#">Dừng</a></li>
                <li id="resetOption"><a id="reset-button" href="#" type="reset">Thiết lập lại</a></li>
                
                <li id="filterOption" class="hidden"><a href="#">Filter</a>
                        <ul class="toolTipMenu filter">
                                <li class="toggleOption" id="datatypeFilteringOption"></li>
                                <li class="toggleOption" id="subclassFilteringOption"></li>
                                <li class="toggleOption" id="disjointFilteringOption"></li>
                                <li class="toggleOption" id="setOperatorFilteringOption"></li>
                                <li class="slideOption" id="nodeDegreeFilteringOption"></li>
                        </ul>
                </li>
                <li id="gravityOption"><a href="#">Kích thước</a>
                        <ul class="toolTipMenu gravity">
                                <li class="slideOption" id="classSliderOption"></li>
                                <li class="slideOption hidden" id="datatypeSliderOption"></li>
                        </ul>
                </li>
                <li id="export"><a href="#">Export</a>
                        <ul class="toolTipMenu export">
                                <li><a href="#" download id="exportSvg">Export as SVG</a></li>
                                <li><a href="#" download id="exportJson">Export as JSON</a></li>
                        </ul>
                </li>
                
        </ul>
</nav>

<script src="/js/d3.min.js"></script>
<script src="/js/webvowl.js"></script>
<script src="/js/webvowl.app.js"></script>
<script>window.onload = webvowl.app().initialize;</script>

<?php
    $sophantu=$sobac;
    $sophantu--;
    $content = '{
    "_comment" : "Created with OWL2VOWL (version 0.2.0), http://vowl.visualdataweb.org",
    "namespace" : [ ],
    "header" : {
      "languages" : [ "IRI-based", "undefined" ],
      "title" : {
        "undefined" : ""
      },
      "iri" : "http://xmlns.com/foaf/0.1/",
      "version" : "0.99",	
      "author" : [ "Dan Brickley", "Libby Miller" ],		
      "description" : {
        "undefined" : "The Friend of a Friend (FOAF) RDF vocabulary, described using W3C RDF Schema and the Web Ontology Language."
      }
    },
    "metrics" : {
      "classCount" : 22,
      "datatypeCount" : 27,
      "objectPropertyCount" : 40,
      "datatypePropertyCount" : 27,
      "propertyCount" : 67,
      "nodeCount" : 49,
      "axiomCount" : 551,
      "individualCount" : 0
    },"class" : [
        ';
    for($i=0;$i<$sophantu;$i++){
        $content=$content.'{
            "id" : "class'.$i.'"';
        
        $content=$content.',
            "type" : "owl:Class"
        },';
    }
    $content=$content.'{
            "id" : "class'.$i.'"';
        
        $content=$content.',
            "type" : "owl:Class"
        }
    ],';
    $content=$content.'"classAttribute" : [';
    for($i=0;$i<$sophantu;$i++){
        $content=$content.'
        {
           "id" : "class'.$i.'"';
        $content=$content.',
            "label" : {
              "IRI-based" : "Concept",
              "undefined" : "'.$i.'"';
        $content=$content.'},
            "instances" : 0
        }
        ,';
        
    }
    $content=$content.'
        {
           "id" : "class'.$i.'"';
        $content=$content.',
            "label" : {
              "IRI-based" : "Concept",
              "undefined" : "'.$i.'"';
        $content=$content.'},
            "instances" : 0
        }
    ],"propertyAttribute" : [';
        
    $soquanhe=0;
    for($i=0;$i<$sobac;$i++){
        for($j=0;$j<$sobac;$j++){
            if($p[$i][$j]>0){
                $soquanhe++;
            }
    }}
    $soquanhe--;
    $demsqh=0;
    for($i=0;$i<$sobac;$i++){
        for($j=0;$j<$sobac;$j++){
            if($p[$i][$j]>0){
                $content=$content.'{
            "id" : "property'.$demsqh.'",
                        "label" : {
              "IRI-based" : "focus",
              "undefined" : "'.$p[$i][$j].'"
            },
            "comment" : {
              "undefined" : "Bieu do trang thai."
            },
            "annotations" : {
              "term_status" : [ {
                "identifier" : "term_status",
                "language" : "undefined",
                "value" : "testing",
                "type" : "label"
              } ]
            },
            "domain" : "class'.$i.'",
            "range" : "class'.$j.'"
        },';
                
                $demsqh++;
                if($demsqh==$soquanhe){
                    break;
                }
            }
        }
        if($demsqh==$soquanhe){
                    break;
                }
    }
    $demsqh=0;
    for($i=0;$i<$sobac;$i++){
        for($j=0;$j<$sobac;$j++){
            if($p[$i][$j]>0){
                $demsqh++;
                if($demsqh==$soquanhe+1){
                    $content=$content.'{
                        "id" : "property'.($demsqh-1).'",
                                    "label" : {
                          "IRI-based" : "focus",
                          "undefined" : "'.$p[$i][$j].'"
                        },
                        "comment" : {
                          "undefined" : "Bieu do trang thai."
                        },
                        "annotations" : {
                          "term_status" : [ {
                            "identifier" : "term_status",
                            "language" : "undefined",
                            "value" : "testing",
                            "type" : "label"
                          } ]
                        },
                        "domain" : "class'.$i.'",
                        "range" : "class'.$j.'"
                    }';
                }
            }
        }
    }
    $content=$content.' ],
    "property":[
        ';
    for($i=0;$i<$soquanhe;$i++){
        $content=$content.'{
            "id" : "property'.$i.'"';
        $content=$content.',
            "type" : "owl:objectProperty"
        },';
    }
    $content=$content.'{
            "id" : "property'.$i.'"';
        $content=$content.',
            "type" : "owl:objectProperty"
        }
        ';
    $content=$content.'
    ]
}';
    $fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/data/bieudo.json","wb");
    fwrite($fp,$content);
    fclose($fp);
?>