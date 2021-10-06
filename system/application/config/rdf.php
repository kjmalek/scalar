<?php

// To add an ontology to Scalar:
// 1) Add its prefix and associated URI to $config['namespaces'] -- this allows the namespace to be added to RDF and RDFa outputs
// 2) Add its predicates (fieldnames) to $config['ontologies'] array -- this provides the fields as options when choosing 'Additional metadata'
// No need to add to Save API controller's allowable prefixes, this is done automatically

// Relationship types
$config['rel'] = array('annotations', 'paths', 'tags', 'replies');
$config['ref'] = array('references');

// Namespaced used for RDF operations
$config['namespaces'] = array(
    					'rdf'       => 'http://www.w3.org/1999/02/22-rdf-syntax-ns#',
      				    'rdfs'      => 'http://www.w3.org/2000/01/rdf-schema#',
  						'dc'        => 'http://purl.org/dc/elements/1.1/',
  						'dcterms'   => 'http://purl.org/dc/terms/',
  						'ctag'      => 'http://commontag.org/ns#',
  						'art'       => 'http://simile.mit.edu/2003/10/ontologies/artstor#',
  						'sioc'      => 'http://rdfs.org/sioc/ns#',
  						'sioctypes' => 'http://rdfs.org/sioc/types#',
  						'foaf'      => 'http://xmlns.com/foaf/0.1/',
  						'owl'       => 'http://www.w3.org/2002/07/owl#',
  						'ov'		=> 'http://open.vocab.org/terms/',
  						'oac'		=> 'http://www.openannotation.org/ns/',
  						'scalar'    => 'http://scalar.usc.edu/2012/01/scalar-ns#',
  						'shoah'		=> 'http://tempuri.org/',
						'prov'		=> 'http://www.w3.org/ns/prov#',
						'exif'		=> 'http://ns.adobe.com/exif/1.0/',
						'iptc'		=> 'http://ns.exiftool.ca/IPTC/IPTC/1.0/',
						'bibo'		=> 'http://purl.org/ontology/bibo/',
						'id3'		=> 'http://id3.org/id3v2.4.0#',
						'dwc'		=> 'http://rs.tdwg.org/dwc/terms/',
						'vra'		=> 'http://purl.org/vra/',
						'cp'		=> 'http://scalar.cdla.oxycreates.org/commonplace/terms/',
						'tk'		=> 'http://localcontexts.org/tk/',  /* Temp */
						'gpano'		=> 'http://ns.google.com/photos/1.0/panorama/'
					   );

// Internet Archive allowable filetypes when importing
$config['internet_archive']['filetypes'] = array(
	'MPEG4',
	'512Kb+MPEG4',
	'h.264',
	'WAVE',
	'QuickTime',
	'160Kbps+MP3',
	'128Kbps+MP3',
	'64Kbps+MP3',
	'56Kbps+MP3',
	'VBR+MP3',
	'JPEG+Thumb',
	'JPEG',
	'Text+PDF'
);

// Database fields to namespace
$config['rdf_fields'] = array(
		'type' => 					'rdf:type',
		'homepage' =>				'foaf:homepage',
		'mbox' =>					'foaf:mbox',
		'mbox_sha1sum' =>			'foaf:mbox_sha1sum',
		'user' => 					'prov:wasAttributedTo',
		'fullname' =>				'foaf:name',
		'title' => 					'dcterms:title',
		'description' => 			'dcterms:description',
		'created' => 				'dcterms:created',
		'table_of_contents' =>		'dcterms:tableOfContents',
		'has_version' =>			'dcterms:hasVersion',
		'version_of' =>				'dcterms:isVersionOf',
		'has_part' =>				'dcterms:hasPart',
		'is_part_of' =>				'dcterms:isPartOf',
		'references' => 			'dcterms:references',
		'has_reference' =>			'dcterms:isReferencedBy',
		'replaces' =>				'dcterms:replaces',
		'replaced_by' =>			'dcterms:isReplacedBy',
		'publisher' =>				'dcterms:publisher',
		'background' =>				'scalar:background',
		'banner' =>					'scalar:banner',
		'color' => 					'scalar:color',
		'audio' => 					'scalar:audio',
		'custom_style' =>			'scalar:customStyle',
		'custom_scripts' =>			'scalar:customScript',
		'urn' => 					'scalar:urn',
		'default_view' =>			'scalar:defaultView',
		'is_live' =>				'scalar:isLive',
		'paywall' =>				'scalar:paywall',
		'has_annotation' => 		'scalar:hasAnnotation',
		'continue_to_content_id' => 'scalar:continue_to_content_id',
		'version' =>				'scalar:version',
		'editorial_state' =>		'scalar:editorialState',
		'usage_rights' =>			'scalar:usageRights',
		'editorial_queries' =>		'scalar:editorial_queries',
		'citation' =>				'scalar:citation',
		'category' =>               'scalar:category',
		'has_edition' =>			'scalar:hasEdition',
		'is_lens_of' =>				'scalar:isLensOf',
		'version_num' => 			'ov:versionnumber',
		'content' => 				'sioc:content',
		'users' =>					'sioc:has_owner',
		'url' =>			    	'art:url',
		'thumbnail' => 				'art:thumbnail',
		'publisher_thumbnail' =>	'art:thumbnail',
		'has_body' => 				'oac:hasBody',
		'has_target' =>				'oac:hasTarget'
);

// Ontology fields available for custom metadata
$config['ontologies'] = array();
$config['ontologies']['dcterms'] = array(
			'abstract',
			'accessRights',
			'accrualMethod',
			'accrualPeriodicity',
			'accrualPolicy',
			'alternative',
			'audience',
			'available',
			'bibliographicCitation',
			'conformsTo',
			'contributor',
			'coverage',
			'created',
			'creator',
			'date',
			'dateAccepted',
			'dateCopyrighted',
			'dateSubmitted',
			'description',
			'educationLevel',
			'extent',
			'format',
			'hasFormat',
			'hasPart',
			'hasVersion',
			'identifier',
			'instructionalMethod',
			'isFormatOf',
			'isPartOf',
			'isReferencedBy',
			'isReplacedBy',
			'isRequiredBy',
			'issued',
			'isVersionOf',
			'language',
			'license',
			'mediator',
			'medium',
			'modified',
			'provenance',
			'publisher',
			'references',
			'relation',
			'replaces',
			'requires',
			'rights',
			'rightsHolder',
			'source',
			'spatial',
			'subject',
			'tableOfContents',
			'temporal',
			'title',
			'type',
			'valid'
);
$config['ontologies']['art'] = array(
			'authority',
			'geographic',
			'hasMediaFile',
			'height',
			'imageId',
			'imageSource',
			'inCollection',
			'lps',
			'lpsid',
			'mediafileFormat',
			'metadataCreationDate',
			'metadataUpdateDate',
			'nationality',
			'objectId',
			'thumbnail',
			'topic',
      'url',
			'resolution',
			'serverurl',
			'sourceLocation',
			'vitalDates',
			'width'
);
$config['ontologies']['iptc'] = array(
    '2#003' => 'ObjectTypeReference',
    '2#004' => 'ObjectAttributeReference',
    '2#005' => 'ObjectName',
    '2#007' => 'EditStatus',
    '2#008' => 'EditorialUpdate',
    '2#010' => 'Urgency',
    '2#012' => 'SubjectReference',
    '2#015' => 'Category',
    '2#020' => 'SupplementalCategories',
    '2#022' => 'FixtureIdentifier',
    '2#025' => 'Keywords',
    '2#026' => 'ContentLocationCode',
    '2#027' => 'ContentLocationName',
    '2#030' => 'ReleaseDate',
    '2#035' => 'ReleaseTime',
    '2#037' => 'ExpirationDate',
    '2#038' => 'ExpirationTime',
    '2#040' => 'SpecialInstructions',
    '2#042' => 'ActionAdvised',
    '2#045' => 'ReferenceService',
    '2#047' => 'ReferenceDate',
    '2#050' => 'ReferenceNumber',
    '2#055' => 'DateCreated',
    '2#060' => 'TimeCreated',
    '2#062' => 'DigitalCreationDate',
    '2#063' => 'DigitalCreationTime',
    '2#065' => 'OriginatingProgram',
    '2#070' => 'ProgramVersion',
    '2#075' => 'ObjectCycle',
    '2#080' => 'By-line',
    '2#085' => 'By-lineTitle',
    '2#090' => 'City',
    '2#092' => 'Sub-location',
    '2#095' => 'Province-State',
    '2#100' => 'Country-PrimaryLocationCode',
    '2#101' => 'Country-PrimaryLocationName',
    '2#103' => 'OriginalTransmissionReference',
    '2#105' => 'Headline',
    '2#110' => 'Credit',
    '2#115' => 'Source',
    '2#116' => 'CopyrightNotice',
    '2#118' => 'Contact',
    '2#120' => 'Caption-Abstract',
    '2#121' => 'LocalCaption',
    '2#122' => 'Writer-Editor',
    '2#125' => 'RasterizedCaption',
    '2#130' => 'ImageType',
    '2#131' => 'ImageOrientation',
    '2#135' => 'LanguageIdentifier',
    '2#150' => 'AudioType',
    '2#151' => 'AudioSamplingRate',
    '2#152' => 'AudioSamplingResolution',
    '2#153' => 'AudioDuration',
    '2#154' => 'AudioOutcue',
    '2#184' => 'JobID',
    '2#185' => 'MasterDocumentID',
    '2#186' => 'ShortDocumentID',
    '2#187' => 'UniqueDocumentID',
    '2#188' => 'OwnerID',
    '2#200' => 'ObjectPreviewFileFormat',
    '2#201' => 'ObjectPreviewFileVersion',
    '2#202' => 'ObjectPreviewData',
    '2#221' => 'Prefs',
    '2#225' => 'ClassifyState',
    '2#228' => 'SimilarityIndex',
    '2#230' => 'DocumentNotes',
    '2#231' => 'DocumentHistory',
    '2#232' => 'ExifCameraInfo',
    '2#255' => 'CatalogSets'
);
// See https://github.com/structureddynamics/Bibliographic-Ontology-BIBO/blob/master/bibo.owl
$config['ontologies']['bibo'] = array(
	// Datatype properties
	'abstract',
	'argued',
	'asin',
	'chapter',
	'coden',
	'doi',
	'eanucc13',
	'edition',
	'eissn',
	'gtin14',
	'handle',
	'identifier',
	'isbn',
	'isbn10',
	'isbn13',
	'issn',
	'issue',
	'lccn',
	'locator',
	'numPages',
	'numVolumes',
	'number',
	'oclcnum',
	'pageEnd',
	'pageStart',
	'pages',
	'pmid',
	'prefixName',
	'section',
	'shortDescription',
	'shortTitle',
	'sici',
	'suffixName',
	'upc',
	'uri',
	'volume',
	// Object properties
	'affirmedBy',
	'annotates',
	'authorList',
	'citedBy',
	'cites',
	'contributorList',
	'court',
	'degree',
	'director',
	'distributor',
	'editor',
	'editorList',
	'interviewee',
	'interviewer',
	'issuer',
	'organizer',
	'owner',
	'performer',
	'presentedAt',
	'presents',
	'producer',
	'recipient',
	'reproducedIn',
	'reversedBy',
	'reviewOf',
	'status',
	'subsequentLegalDecision',
	'transcriptOf',
	'translationOf',
	'translator'
);
$config['ontologies']['id3'] = array(
	'Title',
	'Artist',
	'Album',
	'Year',
	'Comment',
	'Zero-byte',
	'Track',
	'Genre'
);
$config['ontologies']['dwc'] = array(
		'eventDate',
		'georeferencedDate',
		'dateIdentified',
		'relationshipEstablishedDate',
		'measurementDeterminedDate',
		'eventTime',
		'individualCount',
		'decimalLatitude',
		'decimalLongitude',
		'coordinatePrecision',
		'pointRadiusSpatialFit',
		'coordinateUncertaintyInMeters',
		'minimumElevationInMeters',
		'maximumElevationInMeters',
		'minimumDepthInMeters',
		'maximumDepthInMeters',
		'minimumDistanceAboveSurfaceInMeters',
		'maximumDistanceAboveSurfaceInMeters',
		'startDayOfYear',
		'endDayOfYear',
		'year',
		'month',
		'day',
		'footprintSpatialFit',
		'measurementValue',
		'measurementAccuracy',
		'occurrenceRemarks',
		'eventRemarks',
		'locationRemarks',
		'georeferenceRemarks',
		'identificationRemarks',
		'taxonRemarks',
		'organismRemarks',
		'relationshipRemarks',
		'measurementRemarks',
		'catalogNumber',
		'samplingEffort',
		'organismName',
		'verbatimEventDate',
		'verbatimLocality',
		'verbatimElevation',
		'verbatimCoordinates',
		'verbatimLatitude',
		'verbatimLongitude',
		'verbatimDepth',
		'verbatumTaxonRank',
		'otherCatalogNumbers',
		'basisOfRecord',
		'dynamicProperties',
		'collectionCode',
		'institutionCode',
		'ownerInstitutionCode',
		'kingdom',
		'phylum',
		'class',
		'order',
		'family',
		'genus',
		'subgenus',
		'specificEpithet',
		'infraspecificEpithet',
		'higherClassification',
		'vernacularName',
		'nameAccordingTo',
		'scientificName',
		'taxonRank',
		'scientificNameAuthorship',
		'nomenclaturalStatus',
		'namePublishedIn',
		'namePublishedInYear',
		'nomenclaturalCode',
		'originalNameUsage',
		'taxonomicStatus',
		'parentNameUsage',
		'acceptedNameUsage',
		'higherGeography',
		'continent',
		'waterBody',
		'islandGroup',
		'island',
		'countryCode',
		'country',
		'stateProvince',
		'county',
		'municipality',
		'locality',
		'earliestEonOrLowestEonothem',
		'latestEonOrHighestEonothem',
		'earliestEraOrLowestErathem',
		'latestEraOrHighestErathem',
		'earliestPeriodOrLowestSystem',
		'latestPeriodOrHighestSystem',
		'earliestEpochOrLowestSeries',
		'latestEpochOrHighestSeries',
		'earliestAgeOrLowestStage',
		'latestAgeOrHighestStage',
		'lithostratigraphicTerms',
		'group',
		'formation',
		'member',
		'bed',
		'recordedBy',
		'identifiedBy',
		'georeferencedBy',
		'measurementDeterminedBy',
		'locationAccordingTo',
		'georeferenceProtocol',
		'georeferenceSources',
		'samplingProtocol',
		'sex',
		'lifeStage',
		'reproductiveCondition',
		'establishmentMeans',
		'behavior',
		'occurrenceStatus',
		'disposition',
		'verbatimCoordinateSystem',
		'verbatimSRS',
		'geodeticDatum',
		'georeferenceVerificationStatus',
		'footprintWKT',
		'footprintSRS',
		'lowestBiostratigraphicZone',
		'highestBiostratigraphicZone',
		'identificationVerificationStatus',
		'identificationQualifier',
		'preparations',
		'typeStatus',
		'measurementType',
		'measurementUnit',
		'measurementMethod',
		'informationWithheld',
		'dataGeneralizations',
		'habitat',
		'fieldNumber',
		'fieldNotes',
		'recordNumber'
);
$config['ontologies']['vra'] = array(
		'area',
		'author',
		'base',
		'basedOn',
		'builder',
		'cartoonFor',
		'circumference',
		'collector',
		'commissioner',
		'componentOf',
		'composer',
		'contractor',
		'copyOf',
		'count',
		'counterProofFor',
		'creativeActivity',
		'creator',
		'culturalContext',
		'dealer',
		'decorator',
		'depictedIn',
		'depicts',
		'depth',
		'derivedFrom',
		'designedFor',
		'designer',
		'developer',
		'diameter',
		'director',
		'distanceBetween',
		'donator',
		'drafter',
		'drawer',
		'duration',
		'editor',
		'engineer',
		'exhibitedAt',
		'facsimileOf',
		'financier',
		'formerlyLargerContextFor',
		'formerlyPartOf',
		'formerOwner',
		'formerRepository',
		'formerSite',
		'hasCartoon',
		'hasComponent',
		'hasContext',
		'hasCopy',
		'counterProofIs',
		'hasCulture',
		'hasFacsimile',
		'hasImage',
		'hasImpression',
		'hasInscription',
		'hasModel',
		'hasPlan',
		'hasPrintingPlate',
		'hasPrototype',
		'hasReplica',
		'hasStudy',
		'hasStylePeriod',
		'technique',
		'hasVersion',
		'height',
		'imageOf',
		'inventoryLevel',
		'isRelatedTo',
		'largerContextFor',
		'length',
		'locationOf',
		'manufacturer',
		'mateOf',
		'material',
		'modelFor',
		'owner',
		'painter',
		'partnerInSetWith',
		'partOf',
		'pendantOf',
		'performer',
		'photographer',
		'placeOfCreation',
		'placeOfDiscovery',
		'placeOfExhibition',
		'placeOfInstallation',
		'placeOfIntention',
		'placeOfOwnership',
		'placeOfPerformance',
		'placeOfPublication',
		'placeOfRepository',
		'placeOfSite',
		'planFor',
		'preparatoryFor',
		'printer',
		'printingPlateFor',
		'producer',
		'programmer',
		'prototypeFor',
		'reliefFor',
		'replicaOf',
		'restorer',
		'runningTime',
		'sourceFor',
		'studyFor',
		'venueFor',
		'versionOf',
		'wasAlteration',
		'wasBroadcast',
		'wasCommission',
		'wasCreated',
		'wasDesigned',
		'wasDestroyed',
		'wasDiscovered',
		'wasPerformed',
		'wasPresented',
		'wasProduced',
		'wasPublished',
		'wasRestored',
		'weight',
		'width',
		'writer'
);
$config['ontologies']['cp'] = array(
	'url',
	'shortUrl',
	'authors',
	'institution',
	'publisher',
	'date'
);
$config['ontologies']['gpano'] = array(
		'UsePanoramaViewer',
		'CaptureSoftware',
		'StitchingSoftware',
		'ProjectionType',
		'PoseHeadingDegrees',
		'PosePitchDegrees',
		'PoseRollDegrees',
		'InitialViewHeadingDegrees',
		'InitialViewPitchDegrees',
		'InitialViewRollDegrees',
		'InitialHorizontalFOVDegrees',
		'FirstPhotoDate',
		'LastPhotoDate',
		'SourcePhotosCount',
		'ExposureLockUsed',
		'CroppedAreaImageWidthPixels',
		'CroppedAreaImageHeightPixels',
		'FullPanoWidthPixels',
		'FullPanoHeightPixels',
		'CroppedAreaLeftPixels',
		'CroppedAreaTopPixels',
		'InitialCameraDolly'
);
?>
