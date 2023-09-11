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
      { marginLeft: "10%" },
      { marginLeft: "60%" },
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
      { marginLeft: "40%" },
      { marginLeft: "10%" },
    ],
    {
      // timing options
      duration: 800,
      fill: "forwards",
      direction: direction,
    }
  );
}
