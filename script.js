const myButton = document.getElementById("button1");
const myAnimation = document.getElementById("box1");
const myAnimation2 = document.getElementById("box2");

let statut = "connexion";
let direction = "normal";

myButton.addEventListener("click", begin);

function begin() {
  if (statut == "connexion") {
    statut = "inscription";
    direction = "normal";
  } else {
    direction = "reverse";
    statut = "connexion";
  }

  myAnimation.animate(
    [
      // keyframes
      { marginLeft: "0" },
      { marginLeft: "45%" },
    ],
    {
      // timing options
      duration: 800,
      fill: "forwards",
      direction: direction,
    }
  );

  myAnimation2.animate(
    [
      // keyframes
      { marginLeft: "25%" },
      { marginLeft: "0" },
    ],
    {
      // timing options
      duration: 800,
      fill: "forwards",
      direction: direction,
    }
  );
}
