const cards = document.querySelectorAll(".memoryCard");
var isFlipped = false;
var firstCard, secondCard;
var lock = false;
var count;
var moves;
var moves_fail;
var score;
var minutesLabel, secondsLabel;
var totalSeconds;
var play_level;

// refreshed / loads
document.body.onload = start();

const levels = document.querySelectorAll(".play_btn");
levels.forEach(levels_ => levels_.addEventListener("click", getId));

function getId(){
    play_level = document.getElementById("btnClickedValue").value  = this.id;
    // alert(play_level);
}

function endGame() {
	// remove all exisiting classes from each card    
	for (var i = 0; i < cards.length; i++){
    	card = cards[i];
    	card.classList.remove("flip");
    	card.querySelector(".front").style.padding = "0";
    	card.removeEventListener("click", flip);
    	card.removeEventListener("click", congratulations);
		};
    // reset moves
    start();
}

function start() {
	count = moves = score = moves_fail = 0;
	totalSeconds = 0;
	minutesLabel = secondsLabel = "";
    reset();

	cards.forEach(card => card.addEventListener("click", flip));

	cards.forEach(card => card.addEventListener("click",congratulations));

	(function suffle() {
		cards.forEach(card => {
			var position = Math.floor(Math.random() * 16);
			card.style.order = position;
		});
	})();
}

function flip() {
	if (lock) return;
	if (this == firstCard) return;
	this.classList.add("flip");
	if (!isFlipped) {
		isFlipped = true;
		firstCard = this;
		return;
	}
	secondCard = this;
	check();
}

function check() {
	moves++;
	var isMatch = firstCard.dataset.image === secondCard.dataset.image;
	isMatch ? succes() : fail();
}

function succes() {
	score = score + 10;
	firstCard.removeEventListener("click", flip);
	secondCard.removeEventListener("click", flip);
	firstCard.querySelector(".front").style.padding = "5px";
	secondCard.querySelector(".front").style.padding = "5px";
	count ++;
	reset();
}

function fail() {
	score = score - 5;
	lock = true;
	setTimeout(() => {
		firstCard.classList.remove("flip");
		secondCard.classList.remove("flip");
		reset();
	}, 1000);
}

function reset() {
	[isFlipped, lock] = [false, false];
	[firstCard, secondCard] = [null, null];
}

setInterval(setTime, 1000);

function setTime() {
    ++totalSeconds;
    secondsLabel = pad(totalSeconds%60);
    minutesLabel = pad(parseInt(totalSeconds/60));
}

function pad(val) {
    var valString = val + "";
    if(valString.length < 2){
        return "0" + valString;
    }
    else{
        return valString;
    }
}

//modal
var modal = document.querySelector("#popup1")
//close icon in modal
var closeicon = document.querySelector(".close");
//congratulations when all cards match, show modal and moves, time and rating
function congratulations() {
    // if(minutesLabel+":"+secondsLabel <= "01:00"){
	if(minutesLabel+":"+secondsLabel <= "01:30"){
    	if (count == 8){    	
    	    clearInterval(setTime);
    		//show congratulations modal
    		modal.classList.add("show");
    		//showing move, time on modal
    		if (score > 0) {
    			document.querySelector("#h2").innerHTML = "Congratulations 🤗👏";
    			document.querySelector(".content-1").innerHTML = "--🤗 You win this level 😄--";
    			document.querySelector("#next").style.display = "block";
    			} else{
    				document.querySelector("#h2").innerHTML = "Don't be sad 🥺";
    				document.querySelector(".content-1").innerHTML = "--😏 play one more time 😇--";
    				document.querySelector("#next").style.display = "none";
    			}
    	}
    } else{
    	clearInterval(setTime);
    	//show congratulations modal
    	modal.classList.add("show");
    	//showing move, time on modal
    	document.querySelector("#h2").innerHTML = "Time's up 🥺";
    	document.querySelector(".content-1").innerHTML = "--😏 play one more time 😇--";
    	document.querySelector("#next").style.display = "none";
    }
    document.querySelector("#finalMove").innerHTML = moves;
    document.querySelector("#score").innerHTML = score;
    document.querySelector("#totalTime").innerHTML = minutesLabel+":"+secondsLabel;
    closeModal();
}

//close icon on modal
function closeModal() {
    closeicon.addEventListener("click", function(e){
        modal.classList.remove("show");
        endGame();
    });
}

//for player to play Again 
function playAgain() {
    modal.classList.remove("show");
    endGame();
}

//next level
function nextLevel() {
	modal.classList.remove("show");
    endGame();
}

function menu(){
	modal.classList.remove("show");
    endGame();
}
