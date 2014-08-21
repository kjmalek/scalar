/**
 * Scalar    
 * Copyright 2013 The Alliance for Networking Visual Culture.
 * http://scalar.usc.edu/scalar
 * Alliance4NVC@gmail.com
 *
 * Licensed under the Educational Community License, Version 2.0 
 * (the "License"); you may not use this file except in compliance 
 * with the License. You may obtain a copy of the License at
 * 
 * http://www.osedu.org/licenses /ECL-2.0 
 * 
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an "AS IS"
 * BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express
 * or implied. See the License for the specific language governing
 * permissions and limitations under the License.       
 */  

(function($) {

	$.scalarstructuredgallery = function(e, options) {

		var SortMethod = {
			Alpha: 'Alpha'
		}
		
		var DisplayMode = {
			All: 'All',
			Path: 'Path',
			Tag: 'Tag'
		}
	
		var element = e;
		var controlBar;
		var mediaContainer;
		var historyBtn;
		var shrinkBtn;
		var expandBtn;
		var allBtn;
		var pathBtn;
		var tagBtn;
		var thumbnailHeight = 84;
		var currentScale = 1.0;
		var mediaCollection;
		var childPaths;
		var childTags;
		var mediaDetails, children, interval;
		var relationships = ['path', 'tag', 'referee'],
			childRelationships = ['path', 'tag'],
			childLoadIndex = -1,
			contentBlocks = [];
			
		var gallery = {
			options: $.extend({
			}, options),
			
			addNodeToCollection: function( collection, parentNode, relationship, node ) {
				if (collection.all.indexOf(node) == -1) {
					collection.all.push(node);
				}
				if ( collection[parentNode.slug+'-'+relationship] == undefined ) {
					collection[parentNode.slug+'-'+relationship] = [node];
				} else {
					collection[parentNode.slug+'-'+relationship].push(node);
				}
			},
			
			getChildrenOfType: function(node, type) {
				var children = [];
				var i,j,childNodes,childNode,relationship;
				for (j in relationships) {
					relationship = relationships[j];
					childNodes = node.getRelatedNodes(relationship, 'outgoing');
					for (i in childNodes) {
						childNode = childNodes[i];
						if ( type == 'all' ) {
							if ( children.indexOf( childNode ) == -1 ) {
								children.push(childNode);
							}
						} else if (childNode.hasScalarType(type) && (children.indexOf(childNode) == -1)) {
							children.push(childNode);
						}
					}
				}	
				return children;		
			},
			
			resizeThumbnails: function(isAnimated) {
				if (!isAnimated) {
					mediaContainer.find('.thumb').attr('height', (thumbnailHeight * currentScale));
				} else {
					mediaContainer.find('.thumb').animate({'height': (thumbnailHeight * currentScale)});
				}
				//mediaContainer.find('.media_placeholder').height((thumbnailHeight * currentScale)).width((thumbnailHeight * currentScale));
			},
			
			sortCollection: function(collection, method) {
			
				console.log( 'sort' );
				
				switch (method) {
				
					case SortMethod.Alpha:
					collection/*.all*/.sort(function(a, b) {
						var sortTitleA = a.getSortTitle();
						var sortTitleB = b.getSortTitle();
						if (sortTitleA > sortTitleB) {
							return 1;
						} else if (sortTitleA < sortTitleB) {
							return -1;
						}
						return 0;
					});
					break;
				
				}
			
			},
			
			decrementGalleryScale: function() {
				currentScale *= .5;
				gallery.resizeThumbnails(true);
			},
			
			incrementGalleryScale: function() {
				currentScale *= 2.0;
				gallery.resizeThumbnails(true);
			},
			
			setDisplayMode: function(mode) {
			
				if (mode != this.currentDisplayMode) {
					this.currentDisplayMode = mode;
					controlBar.find('.toggle_btn').removeClass('on');
					$('#'+mode.toLowerCase()+'Btn').addClass('on');
					gallery.update(mediaCollection);
				}
			
			},
			
			createContentBlocks: function() {
				
				var i, node, block, block_head,
					n = children.length;
					
				//$( mediaContainer ).append( '<div id="block_head"></div>' );
				
				block_head = $( '<div id="block_head"></div>' ).appendTo( mediaContainer );
				
				for ( i = 0; i < n; i++ ) {
					node = children[ i ];
					
					// create a block where the node's children can be displayed
					block = $( '<div id="block_' + node.slug.replace( "/", "-" ) + '" class="content_block"></div>' ).appendTo( mediaContainer );
					//console.log( "create block: " + node.slug.replace( "/", "-" ) );
					block.data( 'node', node );
					contentBlocks.push( block );
					
					// create a block where the node's thumbnail can be displayed
					block_head.append( '<span id="block_head_' + node.slug.replace( "/", "-" ) + '"></span>' );
				}
				
			},
			
			handleTimer: function() {
			
				var node, scrolledPosition, block,
					n = contentBlocks.length;
					
				for ( var i = ( n - 1 ); i >= 0; i-- ) {
				
					block = contentBlocks[ i ];
					node = block.data( 'node' );
					scrolledPosition = block.offset().top - $( document ).scrollTop();
					//console.log(node.slug+' '+block.position().top+' '+$( document ).scrollTop()+' '+scrolledPosition);
					
					if ( ( scrolledPosition > 0 ) && ( scrolledPosition < window.innerHeight ) ) {
					
						//console.log('load '+node.slug.replace( "/", "-" ));
						
						if (window['Spinner']) {
							var spinnerElement = $('<div class="spinner_wrapper"></div>').appendTo(block);
							var opts = {
							  lines: 13, // The number of lines to draw
							  length: 4, // The length of each line
							  width: 2, // The line thickness
							  radius: 5, // The radius of the inner circle
							  rotate: 0, // The rotation offset
							  color: '#000', // #rgb or #rrggbb
							  speed: 1, // Rounds per second
							  trail: 60, // Afterglow percentage
							  shadow: false, // Whether to render a shadow
							  hwaccel: false, // Whether to use hardware acceleration
							  className: 'spinner', // The CSS class to assign to the spinner
							  zIndex: 2e9, // The z-index (defaults to 2000000000)
							  top: 'auto', // Top position relative to parent in px
							  right: 'auto' // Left position relative to parent in px
							};
							var spinner = new Spinner(opts).spin(spinnerElement[0]);
						}
						
						scalarapi.loadPage( node.slug, true, function( data ) {
						
							var node, index, children;
							
							// get first property to find the node we loaded; technically we shouldn't
							// rely on browsers to deliver the properties in a certain order, but...
							for ( var prop in data ) {
								break;
							}
							node = scalarapi.getNode( prop );
							gallery.addImagesForNode( node );
							
						}, function() {
							console.log('an error occurred while retrieving structured gallery info.');
						}, 1, true);
						
						index = contentBlocks.indexOf( block );
						contentBlocks.splice( index, 1 );
						
					}
				}
				
				if ( n == 0 ) {
					clearInterval( interval );
				}
			},
			
			addHeaderForNode: function( node ) {
			
				var block = $( '#block_' + node.slug.replace( "/", "-" ) );
				
				if (node.current.description != null) {
					block.prepend(' <div class="one_line_description">'+node.current.description+'</div>');
				}
				block.prepend('<h3 class="heading_font"><a href="'+addTemplateToURL(node.url, 'cantaloupe')+'">'+node.getDisplayTitle()+'</a></h3>');
			
			},
			
			addImagesForNode: function( node ) {
			
				var child, i,
					block = $( '#block_' + node.slug.replace( "/", "-" ) ),
					block_head = $( '#block_head_' + node.slug.replace( "/", "-" ) ),
					children = gallery.getChildrenOfType( node, 'all' ),
					n = children.length;
					
				block.find('.spinner_wrapper').remove();
					
				// put child thumbnails inside of the node's block
				for ( i = 0; i < n; i++ ) {
					child = children[ i ];
					if ( child.hasScalarType( 'media' ) ) {
						gallery.addThumbnailForNode( block, child );
					}
				}
				
				// if the node is a media file, add it to the top collection of thumbnails
				if ( node.hasScalarType( 'media' ) ) {
					gallery.addThumbnailForNode( block_head , node );
				} else {
					block_head.remove();
				}
				
				// if a block is empty, remove it, otherwise give it a header
				if ( block.children().length == 0 ) {
					block.remove();
				} else {
					gallery.addHeaderForNode( node );
				}
				
			},
			
			addThumbnailForNode: function( element, node, method ) {
			
				console.log( element );
			
				var alttext, thumbnail,
					me = this;
					
				if ( method == null ) {
					method = 'appendTo';
				}
				
				if (node.current.description != undefined) {
					alttext = node.current.description.replace(/([^"\\]*(?:\\.[^"\\]*)*)"/g, '$1\\"');
				} else {
					alttext = '';
				}		
					
				if ( node.thumbnail != undefined ) {
					var url;
					if ( node.thumbnail.indexOf( "http://" ) == -1 ) {
						url = scalarapi.model.urlPrefix + node.thumbnail;
					} else {
						url = node.thumbnail;
					}
					thumbnail = $( '<img id="img-' + node.slug.replace( "/", "-" ) + '" class="thumb" src="' + url + '" alt="' + 
						alttext + '" height="' + parseInt( thumbnailHeight * currentScale ) + '"/>' )[method]( element );
				} else {
					thumbnail = $( '<img id="img-' + node.slug.replace( "/", "-" ) + '" class="thumb" src="' + modules_uri + 
						'/cantaloupe/images/media_icon_chip.png" alt="' + alttext + '" height="' + 
						parseInt( thumbnailHeight * currentScale ) + '"/>' )[method]( element );
				}
				thumbnail.data('node', node);
				
				thumbnail.click(function() {
					/*if (me.currentDisplayMode != DisplayMode.All) {
						var source = $(this).parent();
						me.mediaDetails.show($(this).data('node'), source.data('node'), source.find('img'));
					} else {*/
						me.mediaDetails.show($(this).data('node'));
					//}
				});
			},
			
			addMedia: function() {
				interval = setInterval(gallery.handleTimer, 1000);
				children = gallery.getChildrenOfType(currentNode, 'all');
				gallery.createContentBlocks();
			}

		};

		gallery.currentDisplayMode = DisplayMode.Path;
		gallery.mediaDetails = $.scalarmediadetails($('<div></div>').appendTo('body'));
		
		mediaContainer = $('<div id="gallery_content"></div>').appendTo(element);
		
		return gallery;
	
	}

})(jQuery);