function openTab(event, AgentType) {
    var i, tabContent, selectedTab;

    tabSections = document.getElementsByClassName("tabsection");
    for (section of tabSections) {
        section.style.display = "none";
    }

    tabButtons = document.getElementsByClassName("tablinks");
    for (button of tabButtons) {
        button.className = button.className.replace(" active", "");
    }

    document.getElementById(AgentType).style.display = "block";
    event.currentTarget.className += " active";
}

function redirectTicket(id) {
    console.log(id);
}