window.addEventListener('DOMContentLoaded', ()=>{
  let maCarte = L.map('carte_campus');

      // 2 : choix du fond de carte
  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '©️ OpenStreetMap contributors'
  }).addTo(maCarte);


          // creation des marqueurs et popup
    let pointsList = [];
    for (let item of document.querySelectorAll('#stations>li')){
      // item est le noeud DOM d'un <li>
      let nom = item.dataset.nom;
      let commune = item.dataset.commune;
      let geoloc = JSON.parse(item.dataset.geo);
      let velos = item.dataset.nbvelosdispo;
      let places = item.dataset.nbplacesdispo;
      let image =  VliveImage.getInstance(velos,places);
      setupListeners(item,L.marker(geoloc, {icon:image.getLeafletIcon()}).addTo(maCarte).bindPopup("<b>nom :</b>"+nom+"<br><b>commune :</b>"+commune+"<br><b>nbvelos :</b>"+velos+"<br><b>nbplaces :</b>"+places));
      
      pointsList.push(geoloc);

    }
         // réglage de la partie visible
    if (pointsList.length>0)
      maCarte.fitBounds(pointsList);


});





// mise en place des listeners
function setupListeners(item, marker){
    // item est le noeud DOM d'un élément li (donc une ville de la liste)
    // marker est le marqueur Leaflet créé pour cette même ville
    item.addEventListener('click', ()=>{
      marker.openPopup();
      setCurrent(item);
      maCarte.setView(marker.getLatLng(),13);
    });
    marker.on("click", ()=>{
      setCurrent(item);
      maCarte.setView(marker.getLatLng(),13);
    });
}
// gestion de l'item courant
{
  let itemCourant = null;

  function setCurrent(item){
      if (itemCourant)
          itemCourant.classList.toggle('current');
      itemCourant = item;
      itemCourant.classList.toggle('current');
  }
}
