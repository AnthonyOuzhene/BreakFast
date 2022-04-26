export const saveFavoris = (favoris) => {
    localStorage.setItem('favoris', JSON.stringify(favoris));
}
export const getFavoris = () => {
    let favoris = localStorage.getItem('favoris')
    if (favoris == null) {
        return [];
    }
    else {
        return JSON.parse(favoris);
    }
}

export const addDelFavoris = (bakeryId) => {
    let favoris = getFavoris();
    let foundBakeryId = favoris.find(b => b == bakeryId);
    if (foundBakeryId == undefined) {
        favoris.push(bakeryId)
    }
    else {
        favoris = favoris.filter(b => b != bakeryId);
    }
    saveFavoris(favoris);
}


