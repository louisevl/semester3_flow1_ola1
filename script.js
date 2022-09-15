
window.addEventListener("load", async () => {
    // Await data to be fetched from endpoint
    const result = await fetch(
      "http://127.0.0.1:8000"
    );
    // Result er det overordnede HTTP response
    console.log(result);
    // Her får vi data:
    const data = await result.json();
    console.log(data);

    dataMiddle = JSON.stringify(data)
    let assets = JSON.parse(dataMiddle)
    //console.log(dataNew)

    //for (let i = 0; i < dataNew.length; i++ ){
        
    
      //  document.getElementById("formerUser").innerHTML = dataNew[i].username
        //document.getElementById("formerPost").innerHTML = dataNew[i].message
    
    
    //}
  
    Object.keys(assets).forEach(key => {
        // get current asset data
        const assetData = assets[key];
        // create asset container
        const container = document.createElement("div");
        // create and append asset header
        const header = document.createElement('h1');
        header.appendChild(document.createTextNode(assetData.username))
        // create and append
        const p1 = document.createElement('p')
        p1.appendChild(document.createTextNode(assetData.message))
        // fill out the asset container
        container.appendChild(header)
        container.appendChild(p1)
        // append the whole thing to the parent
        document.getElementById("formerPips").appendChild(container);
    })
      
    

})



//husk prevent default

const form = document.querySelector("#pip")

form.addEventListener("submit", async (event) => {
    //event.preventDefault();


    const username =  document.querySelector("#username").value //hent brugernavn fra input html
    const pip = document.querySelector("#textarea").value

    const object = {
        username: username,
        message: pip
    }

    const asJason = JSON.stringify(object);

    const result = await fetch("http://127.0.0.1:8000", {
    method: "POST",
    body: asJason
    })

    console.log(result)

    const body = await result.json()
    console.log(body)

})





