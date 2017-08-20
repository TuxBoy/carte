/***************************************************************************************************

****************************************************************************************************/

var carte;	//declaration de la carte
var bounds;	//limite de la carte en fonciton des marqueurs
var marker = []; //tableau contenant tout les marqueurs
var info = []; //tableau contenant toute les info windows
var nbMarker = [];
var tabCoord;
var curentInfoWindows;

/*************************************************************************************/
/*****************************initialise la carte***************************/
/*************************************************************************************/

function InitTab(i)
{
	for (var a = 1; a <= i; a++)
	{
		info[a] = new Array();
		marker[a] = new Array();
		nbMarker[a] = 0;
	}
	curentInfoWindows = new google.maps.InfoWindow(
			{
				content: ""
			});
}

/*************************************************************************************/
/*****************************Definit la carte***************************/
/*************************************************************************************/

function Carte	(
					optZoom,
					Lattitude,
					Longitude,
					optMapTypeId
				)
{
	var optCenterMap = new google.maps.LatLng(Lattitude, Longitude);
	var mapType = google.maps.MapTypeId[optMapTypeId];
	var options =
		{
			center: 				optCenterMap, 		//LatLng(lat:number, lng:number) 		obligatoire
			mapTypeId: 				mapType,			//HYBRID, ROADMAP, SATELLITE, TERRAIN 	obligatoire
			zoom: 					optZoom				//number 								obligatoire
		};
	carte = new google.maps.Map(document.getElementById("map"), options);
	carte.scaleControl = true ;
	bounds = new google.maps.LatLngBounds();
}

/*************************************************************************************/
/**************************definit les marker******************************/
/*************************************************************************************/

Carte.prototype.addMarker = function 	(
											Window,
											Nom,
											Image,
											Latitude,
											Longitude,
											i,
											j,
											bool
										)
{

	nbMarker[i] = j;
	info[i][j] = new google.maps.InfoWindow(
	{
		content: Window
	});
	var optCenterMarker = new google.maps.LatLng(Latitude, Longitude);
	bounds.extend(optCenterMarker);
	marker[i][j] = new google.maps.Marker(
	{
		position : 	optCenterMarker,
		title : 	Nom,
		icon : 		Image,
		visible:	bool,
		map : 		carte
	});
	google.maps.event.addListener(marker[i][j], 'click', function()
	{
		curentInfoWindows.close();
		curentInfoWindows = info[i][j];
		info[i][j].open(carte, marker[i][j]);
	});
	carte.fitBounds(bounds);
};

/*************************************************************************************/
/****************************definit la checkbox***************************/
/*************************************************************************************/


function boxclick(box, i)
{
	if (box.checked)
	{
		for (var a = 1; a <= nbMarker[i]; a++)
		{
			marker[i][a].setVisible(true);
		}
	} else
	{
		for (var a = 1; a <= nbMarker[i]; a++)
		{
			marker[i][a].setVisible(false);
		}
	}
};

function AllBoxClick(box)
{
	var monForm = document.getElementById("checkbox");
	if (box.checked)
	{
		for (var i = 1; i <= monForm.elements.length; i++)
		{
			monForm.elements[i-1].checked = true;
		}
		setTimeout("this.AllView(1)",1);
	} else
	{
		for (var i = 1; i <= monForm.elements.length; i++)
		{
			monForm.elements[i-1].checked = false;
		}
		setTimeout("this.AllView(0)",1);
	}
};

function AllView(box)
{
	var monForm = document.getElementById("checkbox");
	if (box)
	{
		for (var i = 1; i <= monForm.elements.length; i++)
		{
			for (var b = 1; b <= nbMarker[i]; b++)
			{
				marker[i][b].setVisible(true);
			}
		}
	} else
	{
		for (var i = 1; i <= monForm.elements.length; i++)
		{
			for (var b = 1; b <= nbMarker[i]; b++)
			{
				marker[i][b].setVisible(false);
			}
		}
	}
};



