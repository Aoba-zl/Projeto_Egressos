const serverUrl = "http://localhost:8000/api/";

// consultar mdn docs
async function generateHash(value) {
    value+="portalDeEgressosFatecZlSalt";
    const encoder = new TextEncoder();
    const data = encoder.encode(value);
    const hashBuffer = await window.crypto.subtle.digest("SHA-256", data);

    const hashArray = Array.from(new Uint8Array(hashBuffer)); // convert buffer to byte array
    const hashHex = hashArray
      .map((b) => b.toString(16).padStart(2, "0"))
      .join(""); // convert bytes to hex string

    return hashHex;
}

/*  ============== SESSION ==================    */
function setStorage(name,value){
  sessionStorage.setItem(name,value);
}

function deleteStorage(name){
  sessionStorage.removeItem(name);
}

function getStorage(name) {
  return sessionStorage.getItem(name);
}