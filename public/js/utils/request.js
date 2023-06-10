// Default options are marked with *
async function request(url = "", method = "POST", body = {}, options = {
  mode: "cors",                     // no-cors, *cors, same-origin
  cache: "no-cache",                // *default, no-cache, reload, force-cache, only-if-cached
  credentials: "same-origin",       // include, *same-origin, omit,
  headers: {
    "Content-Type": "application/json",
    "X-Requested-With": "XMLHttpRequest"
  },
  redirect: "follow",               // manual, *follow, error
  referrerPolicy: "no-referrer"     // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
}) {
    const params = {
      method,
      mode: options?.mode || 'cors',
      cache: options?.cache || 'default',
      credentials: options?.credentials || 'same-origin',
      headers: options?.headers || {},
      redirect: options?.redirect || 'follow',
      referrerPolicy: options?.referrerPolicy || 'no-referrer-when-downgrade'
    };

    if (body && method !== 'GET') {
      params.body = body;
    }

    const response = await fetch(url, params);
    
    return response.json(); // parses JSON response into native JavaScript objects
}