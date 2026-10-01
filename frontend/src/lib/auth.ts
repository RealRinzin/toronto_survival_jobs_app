interface LoginDType {
    email: string,
    password: string,
}
import { promises } from "dns";
import { getCookie } from "./csrf_cookie";
// Get the CSRF Token
async function getCSRFCookie() {
    await fetch(`${process.env.NEXT_PUBLIC_API_URL}/sanctum/csrf-cookie`)
}

// Login
export async function login(email: string, password: string): Promise<LoginDType> {

    // Call the Cookies
    await getCSRFCookie();
    // Step 2 — login the user
    // This function will throw an error if the login fails, so you can catch it in your component and display an error message to the user.
    /**
     * In this function, we are making a POST request to the login endpoint of our backend API.
     *  We include the username and password in the request body as JSON. We also include the CSRF token in the headers, which we retrieve from the cookie using the `getCookie` function. 
     * The `credentials: 'include'` option is used to ensure that cookies are sent with the request, which is necessary for authentication to work properly. 
     * If the login is successful, we return the response as JSON. If the login fails, we throw an error with the message from the response.
     */
    const res = await fetch(`${process.env.NEXT_PUBLIC_BACKEND_API_URL}/login`, {
        method: 'POST', // use POST method for login
        credentials: 'include', // required to send cookies with the request
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-XSRF-TOKEN': decodeURIComponent(getCookie('XSRF-TOKEN') ?? ''),  // include the CSRF token from the cookie in the headers
        },
        // 
        body: JSON.stringify({ email, password }), // send the username and password in the request body as JSON
    });
    if (!res.ok) {
        const error = await res.json(); // get the error message from the response
        throw new Error(error.message || 'Login failed'); // throw an error with the message from the response, or a default message if the response does not include a message
    }
    // If the login is successful, we return the response as JSON. 
    // The response should include the user data and any authentication tokens that are needed for subsequent requests.
    return res.json();

}