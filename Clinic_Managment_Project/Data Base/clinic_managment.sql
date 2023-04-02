create database clinic_management;
use clinic_management; 

CREATE TABLE patients (
  patient_id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  patient_type VARCHAR(255),
  dob DATE NOT NULL,
  age INT,
  gender VARCHAR(10),
  patients_address TEXT,
  contact BIGINT(10),
  allergies VARCHAR(255),
  appointment_date DATE,
  appointment_time TIME,
  PRIMARY KEY (patient_id)
  -- FOREIGN KEY (treat_id) REFERENCES treatments(treat_id)
);

CREATE TABLE treatments (
  treat_id INT NOT NULL AUTO_INCREMENT,
  treat_type VARCHAR(255) NOT NULL,
  treat_name VARCHAR(255) NOT NULL,
  patient_id INT,
  PRIMARY KEY (treat_id),
  FOREIGN KEY (patient_id) REFERENCES patients(patient_id)
);

CREATE TABLE check_up (
  check_id INT NOT NULL AUTO_INCREMENT,
  patient_id INT NOT NULL,
  complains TEXT,
  treat_id INT,
  checkUp_date DATE,
  PRIMARY KEY (check_id),
  FOREIGN KEY (patient_id) REFERENCES patients(patient_id),
  FOREIGN KEY (treat_id) REFERENCES treatments(treat_id)
);

CREATE TABLE medicines (
  med_code INT NOT NULL AUTO_INCREMENT,
  med_name VARCHAR(255) NOT NULL,
  quantity INT,
  available_qty INT,
  description TEXT,
  expiry_date DATE,
  price DECIMAL(10,2),
  PRIMARY KEY (med_code)
);

CREATE TABLE equipments (
  equip_id INT NOT NULL AUTO_INCREMENT,
  equip_name VARCHAR(255) NOT NULL,
  purchase_date DATE NOT NULL,
  manufacturer VARCHAR(255) NOT NULL,
  model VARCHAR(255),
  description TEXT,
  price DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (equip_id)
);


CREATE TABLE employees (
  emp_id INT NOT NULL,
  emp_name VARCHAR(255) NOT NULL,
  emp_type VARCHAR(255) NOT NULL,
  employees_address TEXT,
  salary DECIMAL(10,2),
  hire_date DATE,
  gender VARCHAR(10),
  date_of_birth DATE,
  contact BIGINT(10),
  PRIMARY KEY (emp_id)
);


CREATE TABLE rooms (
  room_no INT NOT NULL,
  room_type VARCHAR(255) NOT NULL,
  period INT,
  occupied_by VARCHAR(255),
  max_capacity INT NOT NULL,
  current_capacity INT DEFAULT 0,
  description TEXT,
  PRIMARY KEY (room_no)
);


INSERT INTO patients (name, patient_type, dob, age, gender, patients_address, contact, allergies, appointment_date, appointment_time)
VALUES 
  ('Mary Johnson', 'Outpatient', '1995-09-12', 28, 'Female', '456 Pine St, Anytown, USA', 5552345, 'Latex', '2023-04-09', '09:30:00'),
  ('David Lee', 'Inpatient', '1976-03-15', 47, 'Male', '123 Oak Rd, Anytown, USA', 5556789, 'Penicillin', '2023-04-12', '16:30:00'),
  ('Susan Kim', 'Outpatient', '2000-01-01', 23, 'Female', '789 Elm St, Anytown, USA', 5553456, 'Shellfish', '2023-04-18', '14:45:00'),
  ('Mark Smith', 'Inpatient', '1965-12-25', 57, 'Male', '321 Maple Ave, Anytown, USA', 5557890, 'None', '2023-04-13', '08:00:00'),
  ('Emily Chen', 'Outpatient', '1988-06-30', 33, 'Female', '987 Pine Ln, Anytown, USA', 5550123, 'Eggs', '2023-04-19', '13:00:00');



INSERT INTO treatments (treat_type, treat_name, patient_id)
VALUES
('General Checkup', 'Physical Exam', 1),
('Dental', 'Teeth Cleaning', 2),
('Surgery', 'Appendectomy', 3),
('Physical Therapy', 'Shoulder Rehabilitation', 4),
('General Checkup', 'Annual Exam', 5);

INSERT INTO check_up (patient_id, complains, treat_id, checkUp_date)
VALUES
(1, 'Headache and fever', 1, '2023-04-05'),
(2, 'Sore gums and bad breath', 2, '2023-04-08'),
(3, 'Abdominal pain', 3, '2023-04-09'),
(4, 'Shoulder pain and stiffness', 4, '2023-04-12'),
(5, 'Yearly physical exam', 5, '2023-04-14');

INSERT INTO medicines (med_name, quantity, available_qty, description, expiry_date, price)
VALUES
('Ibuprofen', 100, 75, 'For pain relief and fever reduction', '2024-06-01', 5.99),
('Amoxicillin', 50, 25, 'For bacterial infections', '2022-12-31', 7.99),
('Lisinopril', 30, 10, 'For high blood pressure', '2023-10-15', 12.99),
('Atorvastatin', 60, 30, 'For high cholesterol', '2023-11-30', 18.99),
('Albuterol', 20, 15, 'For asthma and other respiratory issues', '2023-09-30', 15.99);

INSERT INTO equipments (equip_name, purchase_date, manufacturer, model, description, price)
VALUES 
('X-Ray Machine', '2022-03-28', 'ABC Company', 'XRAY-1000', 'Digital X-Ray Machine', 25000.00),
('Ultrasound Machine', '2022-01-15', 'XYZ Medical', 'ULTRA-2000', 'Portable Ultrasound Machine', 12000.00),
('Surgical Table', '2021-11-10', 'PQR Industries', 'SURG-3000', 'Electric Operating Table', 4000.00),
('Patient Monitor', '2022-02-05', 'EFG Medical', 'MON-5000', 'Multi-Parameter Patient Monitor', 5000.00),
('Defibrillator', '2022-04-01', 'QRS Electronics', 'DEFIB-100', 'Manual Defibrillator', 3000.00);


INSERT INTO employees (emp_id, emp_name, contact, emp_type, employees_address, salary, hire_date, gender, date_of_birth)
VALUES 
  (1, 'John Smith', 1234567890, 'Doctor', '123 Main St, Anytown USA', 100000.00, '2022-01-01', 'M', '1980-01-01'),
  (2, 'Jane Doe', 9876543210, 'Nurse', '456 Maple Ave, Somewhere USA', 60000.00, '2022-01-01', 'F', '1990-01-01'),
  (3, 'Mike Johnson', 5555555555, 'Administrator', '789 Oak St, Anytown USA', 80000.00, '2022-01-01', 'M', '1985-01-01'),
  (4, 'Mary Williams', 4444444444, 'Receptionist', '321 Elm St, Anytown USA', 40000.00, '2022-01-01', 'F', '1995-01-01'),
  (5, 'Bob Davis', 1111111111, 'Janitor', '555 Pine St, Anytown USA', 30000.00, '2022-01-01', 'M', '1988-01-01');



INSERT INTO rooms (room_no,room_type, period, occupied_by, max_capacity, current_capacity, description)
VALUES 
(101,'Standard', 30, NULL, 2, 1, 'Basic room with two beds and a shared bathroom.'),
(102,'Deluxe', 60, 'John Smith', 4, 2, 'Spacious room with a queen bed, a sofa bed, and a private bathroom.'),
(103,'Suite', 90, 'Jane Doe', 6, 3, 'Luxury room with two bedrooms, a living area, and a jacuzzi.'),
(104,'ICU', NULL, 'Mike Johnson', 1, 1, 'Intensive care unit with specialized medical equipment and constant monitoring.'),
(105,'Operating Room', NULL, NULL, 10, 0, 'Surgical suite equipped with state-of-the-art technology and instruments.');



-- select * from treatments;
-- select * from patients;
	-- select * from check_up;
-- select * from medicines;
-- select * from equipments;
-- select * from employees;
-- select * from rooms;

-- INSERT INTO patients (name, patient_type, age, address) VALUES 
-- ('John Doe', 'Outpatient', 45, '123 Main St, Anytown, USA');

-- INSERT INTO treatments (treat_type, treat_name) VALUES 
-- ('xyz', 'xyz');

-- update treatments set treat_type="ABC" where treat_id=3;

-- DELETE FROM patients WHERE patient_id = 5;

INSERT INTO patients (name, patient_type, dob, age, gender, patients_address, contact, allergies, appointment_date, appointment_time)
VALUES 
  ('Abc', 'Outpatient', '1995-09-12', 28, 'Female', '456 Pine St, Anytown, USA', 5552345, 'Latex', '2023-04-09', '09:30:00');
  
  UPDATE patients
SET name = 'new name'
WHERE patient_id = 3;

select* from patients;
