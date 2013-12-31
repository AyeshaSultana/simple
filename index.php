<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Demo: Layout with Dijit</title>
        <link rel="stylesheet" href="css/demo.css" media="screen">
<!--		<link rel="stylesheet" href="http://dojotoolkit.org/documentation/tutorials/resources/style/demo.css" media="screen">-->
		<link rel="stylesheet" href="css/style.css" media="screen">
        <!--<link rel="stylesheet" href="dijit/themes/claro/claro.css" media="screen">-->
		<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/dojo/1.7.5/dijit/themes/claro/claro.css" media="screen">
    </head>
    <body class="claro">

    	<div id="loadingOverlay" class="loadingOverlay pageOverlay"><div class="loadingMessage">Loading...</div></div>

        <div id="appLayout" class="demoLayout" data-dojo-type="dijit.layout.BorderContainer" data-dojo-props="design: 'headline'">
            <!--<div class="edgePanel" id="menuItem" data-dojo-type="dijit.layout.ContentPane" data-dojo-props="region: 'top'">dd</div> -->
            <div class="edgePanel" id="wrapper" data-dojo-type="dijit.layout.ContentPane" data-dojo-props="region: 'top'" style="left:0; top:0">FF</div>                        
            <div id="leftCol" class="edgePanel" data-dojo-type="dijit.layout.ContentPane" data-dojo-props="region: 'left', splitter: true"style="border:none;">
                <div id="markup" style="width: 350px; height: 300px" data-dojo-type="dijit.layout.AccordionContainer" data-dojo-props="region: leading">
                    <div id="treeOne" data-dojo-type="dijit.tree.TreeStoreModel"></div>
                </div>

            </div>
            <div class="centerPanel" data-dojo-type="dijit.layout.BorderContainer" data-dojo-props="region: 'center'">
                <div id="centerTop" class="demoLayout" style="width: 50%; " data-dojo-type="dijit.layout.ContentPane" data-dojo-props="design:'sidebar', region: 'center', splitter: true"></div>
                <!--<div id="centerBottom" class="edgePanel" style="height:50%" data-dojo-type="dijit.layout.ContentPane" data-dojo-props="region: 'center'">center-top</div>-->
            </div>            
        </div>
        <!-- load dojo and provide config via data attribute -->
        <script src="dojo/dojo.js"
                data-dojo-config="async: 1, parseOnLoad: 1">
        </script>
        <script>
            require(["dojo/parser", "dijit/layout/AccordionContainer", "dijit/layout/BorderContainer", "dijit/layout/TabContainer", "dijit/layout/ContentPane", "dojo/domReady","dojo/ready",
                "dijit/Tree", "dojo/data/ItemFileReadStore", "dijit/tree/ForestStoreModel"
                ], function(parser,AccordionContainer, ContentPane, ready){                    
                    var aContainer = new AccordionContainer({style:"height: 300px"}, "markup");
                    aContainer.addChild(new ContentPane({
                        title: "Tree",
                        content: "Hi!"
                    }));
                    aContainer.addChild(new ContentPane({
                        title:"This is as well",
                        content:"Hi how are you?"
                    }));
                    aContainer.addChild(new ContentPane({
                        title:"This too",
                        content:"Hello im fine.. thnx"
                    }));
                    aContainer.startup();           
                    parser.parse();
                    demo.endLoading();
                },
                function(Tree, ItemFileReadStore, ForestStoreModel){
                    var store = new ItemFileReadStore({
                        url: "mo/Network.json"
                    });
                    var treeModel = new ForestStoreModel({
                        store: store,
                        query: {"type": "continent"},
                        rootId: "root",
                        rootLabel: "Continents",
                        childrenAttrs: ["children"]
                    });

                    var myTree = new Tree({
                        model: treeModel
                    }, "treeOne");
                    myTree.startup();
                }
            );             
        </script>
        <script type="text/javascript">
        	var demo;
			require(["dojo/_base/declare","dojo/dom","dojo/dom-style"],
			function(declare, dom, domStyle){
			    var Demo = declare(null, {
			        overlayNode:null,
			        constructor:function(){
			            // save a reference to the overlay
			            this.overlayNode = dom.byId("loadingOverlay");
			        },
			        // called to hide the loading overlay
			        endLoading:function(){
			            domStyle.set(this.overlayNode,'display','none');
			        }
			    });
			    demo = new Demo();
			});
        </script>
    </body>
</html>