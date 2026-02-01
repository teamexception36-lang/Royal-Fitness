-- Add columns to your existing users table if they don't exist
ALTER TABLE users ADD COLUMN active_plan VARCHAR(50) DEFAULT 'No Active Plan';
ALTER TABLE users ADD COLUMN weight FLOAT;
ALTER TABLE users ADD COLUMN height FLOAT;
ALTER TABLE users ADD COLUMN bmi_score FLOAT;

-- Create a table for trainer programs
CREATE TABLE trainer_programs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    program_name VARCHAR(100),
    workout_details TEXT,
    diet_plan TEXT,
    assigned_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);