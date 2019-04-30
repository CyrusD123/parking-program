// from spaces[0] to spaces[19]
var spaces = new Array(20).fill("Occupied");
function emptySpace() {
    var num = document.getElementById("leave_num").value;
    var intSpace = Number(num);
    if (intSpace > 0 && intSpace < (spaces.length+1) && spaces[intSpace-1] == "Occupied") {
        spaces[intSpace-1] = "Empty";
    }
    else {
        alert("Error! Invalid Space Number.");
    }
}
function occupySpace(space) {
    var num = document.getElementById("occupy_num").value;
    var intSpace = Number(num);
    if (intSpace > 0 && intSpace < (spaces.length+1) && spaces[intSpace-1] == "Empty") {
        spaces[intSpace-1] = "Occupied";
    }
    else {
        alert("Error! Invalid Space Number.");
    }
}
function listEmpty() {
    var listElements = 0;
    var elementTracker = 0;
    for (i = 0; i < spaces.length; i++) {
        if (spaces[i] == "Empty") {
            listElements++;
        }
    }
    if (listElements == 0) {
        document.getElementById("emptyList").innerHTML = "None";
    }
    else {
            var emptySpaces = new Array(listElements);
        for (i = 0; i < spaces.length; i++){
            if (spaces[i] == "Empty") {
                emptySpaces[elementTracker] = i+1
                elementTracker++;
            }
        }
        document.getElementById("emptyList").innerHTML = emptySpaces;
    }
}

/*
TODO:
- Create table
- put into code with php
Add CSS
Add Ads?

git add .
git commit -m "comment"
git push heroku master

heroku logs --tail -a parking-program
*/