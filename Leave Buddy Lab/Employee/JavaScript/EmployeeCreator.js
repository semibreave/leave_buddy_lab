// Import the getEmployeeData function from employeeAjax.js
import { getEmployeeData } from '../AJAX/AjaxGetEmployeeProp.js';

// Import Employee class from Employee.js
import { Employee } from './Employee.js';

// Create a function to retrieve and instantiate the Employee object
export async function getEmployeeById(employeeId) {
  try {
    // Fetch employee data from the database using the provided ID
    const employeeData = await getEmployeeData(employeeId);

    // Convert ID to int
    const ID = parseInt(employeeData.ID);

    // Convert to date object and set the hour to 00:00
    const startDate = new Date(employeeData.startDate);
    startDate.setHours(0, 0, 0);

    // Convert entitlement to int
    const entitlement = parseInt(employeeData.entitlement);

    // Convert JSON to array
    const leaveArr = JSON.parse(employeeData.leaveArr);

    // Convert string to float
    const balance = parseFloat(employeeData.balance);

    // Create and return the Employee object
    return new Employee(employeeData.name, ID, startDate, entitlement, leaveArr, balance);
  } 
  
  catch (error) {
    console.error(error);
    return null; // Return null or handle the error appropriately in your application
  }
}

