var bands;
(function (bands) {
    bands[bands["Motorhead"] = 0] = "Motorhead";
    bands[bands["Metallica"] = 1] = "Metallica";
    bands[bands["Slayer"] = 2] = "Slayer";
})(bands || (bands = {}));
console.log(bands);
var myFavoriteBand = bands[2];
console.log(myFavoriteBand);
