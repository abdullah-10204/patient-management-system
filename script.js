window.addEventListener("click", (event) => {
    let dropdownBtn = document.querySelectorAll(".dropdownBtn");
    let isInsideDropdown = false;

    dropdownBtn.forEach(btn => {
        let insideDropdown = btn.nextElementSibling;

        if (insideDropdown.classList.contains("open")) {
            if (event.target === btn || event.target === insideDropdown || insideDropdown.contains(event.target)) {
                isInsideDropdown = true;
            } else {
                insideDropdown.classList.remove("open");
            }
        }
    });

    if (!isInsideDropdown) {
        dropdownBtn.forEach(btn => {
            let insideDropdown = btn.nextElementSibling;

            if (insideDropdown.classList.contains("open")) {
                insideDropdown.classList.remove("open");
            }
        });
    }
});

document.querySelectorAll(".dropdownBtn").forEach(btn => {
    btn.addEventListener("click", (event) => {
        event.stopPropagation();
        let insideDropdown = btn.nextElementSibling;

        if (insideDropdown.classList.contains("open")) {
            insideDropdown.classList.remove("open");
        } else {
            document.querySelectorAll(".insideDropdown.open").forEach(inside => {
                inside.classList.remove("open");
            });
            insideDropdown.classList.add("open");
        }
    });
});


let innerDropdownBtn = document.querySelectorAll(".innerDropdownBtn");

innerDropdownBtn.forEach(btn => {
    btn.addEventListener("click", () => {
        let innerDropdown = btn.nextElementSibling;
        if (innerDropdown.classList.contains("open")) {
            innerDropdown.classList.remove("open");
        } 
        else 
        {
            let allInnerDropdown = document.querySelectorAll(".innerDropdown.open");
            allInnerDropdown.forEach(inner => {
                inner.classList.remove("open");
            });
            innerDropdown.classList.add("open");
        }
    });
});


// Code to get user's location 
let detectLocation = document.getElementById("detectLocation");

const showLocation = async (position) => {
    try {
        let response  = await fetch(`https://nominatim.openstreetmap.org/reverse?lat=${position.coords.latitude}&lon=${position.coords.longitude}&format=json`);
        let data = await response.json();
        console.log(data);
        document.getElementById("location").value = data.address.district;
    } catch (error) {
        console.error("Error fetching location:", error);
    }
}

const showError = (error) => {
    console.error("Error getting location:", error);
    console.log("Fallback location or error handling goes here...");
}

if(detectLocation)
{
    detectLocation.addEventListener("click", () =>{
        navigator.geolocation.getCurrentPosition(showLocation, showError);
    });
}
