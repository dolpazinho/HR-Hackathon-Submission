const search = document.getElementById('searchTerm_en');
const matchList = document.getElementById('result');

const searchStates = async searchText =>{
    const res = await fetch('./js/data.json');
    const states = await res.json();

    let matches = states.filter(state => {
        const regex = new RegExp(`^${searchText}`,'gi');
        return state.name.match(regex);
    });

    if(searchText.length === 0){
        matches = [];
        matchList.innerHTML = '';
    }
    outputHtml(matches);
};

const outputHtml = matches => {
    if(matches.length > 0){
        const html = matches.map(match =>
            `<div class="card result-list en">
						<h6><span class="my-result"><a href="${match.url}" target="_blank">${match.name}</a> </h6></span>
					</div>`).join('');
        matchList.innerHTML = html;
    }
};
search.addEventListener('input', () => searchStates(search.value));
