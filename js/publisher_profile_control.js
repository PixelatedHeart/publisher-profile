// Don't show elements in edit page

try {
  document.getElementById("title").disabled = true;
} catch (err) {
  console.log("error disabled title");
}

try {
  document.getElementById("normal-sortables").innerHTML = "";
} catch (err) {
  console.log("error normal-sortables innerHTML");
}

try {
  document.getElementById("categorydiv").innerHTML = "";
} catch (err) {
  console.log("error innerHTML categorydiv");
}

try {
  document.getElementById("tagsdiv-post_tag").innerHTML = "";
} catch (err) {
  console.log("error tagsdiv-post_tag innerHTML");
}

try {
  document.getElementById("edit-slug-buttons").remove();
} catch (err) {
  console.log("error edit-slug-buttons remove");
}

try {
  document.getElementById("formatdiv").innerHTML = "";
} catch (err) {
  console.log("error innerHTML formatdiv");
}
