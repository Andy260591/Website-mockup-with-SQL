filterSelection("all");
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("filterDiv");
  if (c == "all") c = "";
  // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

// Show filtered elements
function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {
      element.className += " " + arr2[i];
    }
  }
}

// Hide elements that are not selected
function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);
    }
  }
  element.className = arr1.join(" ");
}

// Add active class to the current control button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function () {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}

window.addEventListener("DOMContentLoaded", () => {
  const hash = window.location.hash.replace("#", "");
  if (hash) {
    filterSelection(hash);

    // Optional: scroll to the section
    const section = document.getElementById(hash);
    if (section) section.scrollIntoView({ behavior: "smooth" });
  }
});

// pentru selectare filtru

function setActiveFilter(modelName) {
  document.querySelectorAll(".model-filter .btn").forEach((btn) => {
    btn.classList.remove("active");
  });

  const btn = document.querySelector(
    `.model-filter .btn[data-model="${modelName}"]`
  );
  if (btn) {
    btn.classList.add("active");
  }
}

function getHashModel() {
  return decodeURIComponent(window.location.hash.substring(1)); // removes #
}

window.addEventListener("DOMContentLoaded", () => {
  const model = getHashModel();

  if (model) {
    filterSelection(model); // your existing JS function
    setActiveFilter(model); // visually activate button
  } else {
    filterSelection("all"); // default
    setActiveFilter("all");
  }
});
