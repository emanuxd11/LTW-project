function openTab(event, AgentType) {
    var i, tabContent, selectedTab;

    tabContent = document.getElementsByClassName("tabsection");
    for (i = 0; i < tabContent.length; i++) {
        tabContent[i].style.display = "none";
    }

    tabButtons = document.getElementsByClassName("tablinks");
    for (i = 0; i < tabButtons.length; i++) {
        tabButtons[i].className = tabButtons[i].className.replace(" active", "");
    }

    document.getElementById(AgentType).style.display = "block";
    event.currentTarget.className += " active";
}