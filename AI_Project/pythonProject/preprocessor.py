import re  # Importing the regular expression module
import pandas as pd  # Importing pandas for data manipulation

def preprocess(data):
    # Define regular expression pattern to match dates and times
    pattern = r'(\d{1,2}/\d{1,2}/\d{2,4}, \d{1,2}:\d{1,2}\s?[APMapm]{2})'

    # Split the data using the pattern to separate messages and dates
    messages = re.split(pattern, data)[1:]

    # Remove '\u202f' characters from messages
    cleaned_messages = [message.replace('\u202f', '') for message in messages]

    # Find all dates in the data
    dates = re.findall(pattern, data)

    # Remove '\u202f' characters from dates
    cleaned_dates = [date.replace('\u202f', '') for date in dates]

    # Ensure arrays have the same length
    min_length = min(len(cleaned_messages), len(cleaned_dates))
    cleaned_messages = cleaned_messages[:min_length]
    cleaned_dates = cleaned_dates[:min_length]

    # Create a DataFrame with cleaned messages and dates
    df = pd.DataFrame({'user_message': cleaned_messages, 'message_dates': cleaned_dates})

    # Convert message_date type with corrected format
    df['message_date'] = pd.to_datetime(df['message_dates'], format='%m/%d/%y, %I:%M%p')
    df.rename(columns={'message_date': 'date'}, inplace=True)

    users = []
    messages = []

    # Split user and message using regular expression
    for message in df['user_message']:
        entry = re.split('([\w\W]+?):\s', message)  # Add missing equal sign and colon
        if entry[1:]:  # Check if entry has user name and message
            users.append(entry[1])
            messages.append(entry[2])
        else:
            users.append('group_notification')
            messages.append(entry[0])

    # Add user and message columns to DataFrame
    df['user'] = users
    df['message'] = messages
    df.drop(columns=['user_message'], inplace=True)

    # Extract date components and add as separate columns
    df['only_date'] = df['date'].dt.date
    df['year'] = df['date'].dt.year
    df['month_num'] = df['date'].dt.month
    df['month'] = df['date'].dt.month_name()
    df['day'] = df['date'].dt.day
    df['day_name'] = df['date'].dt.day_name()
    df['hour'] = df['date'].dt.hour
    df['minute'] = df['date'].dt.minute

    # Create time period based on the hour of the message
    period = []
    for hour in df['hour']:
        if hour == 23:
            period.append(str(hour) + "-" + str('00'))
        else:
            period.append(str(hour) + "-" + str(hour + 1))

    df['period'] = period

    return df
