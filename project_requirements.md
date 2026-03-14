CallFrend – Project Requirements Document

Version

1.0

Platform Type

Anonymous Voice Conversation Platform

Target Hosting Environment

Hostinger Shared Hosting

Backend Technology

PHP

Database

MySQL


---

1. Project Overview

CallFrend is a global anonymous voice communication platform where users can connect with strangers through voice-only conversations without revealing their identity.

The platform allows people to interact through real-time voice calls while maintaining complete anonymity.

Users will not see personal details such as:

phone number

email address

real name


Instead the platform will only show:

anonymous user ID

gender icon

language indicator


The goal of the platform is to create a safe, engaging, and scalable anonymous communication experience.


---

2. Platform Goals

The platform must provide:

anonymous voice communication

fast and intelligent user matching

global language support

safe moderated environment

subscription-based premium features

advertisement monetization

scalable backend architecture



---

3. Platform Architecture

The platform must support multiple environments.

Primary platform:

Web Application

Additional platform:

Progressive Web App (PWA)

Future expansion:

Android Native Application
iOS Native Application

The backend architecture must remain shared across all platforms.


---

4. Hosting Requirements

The platform must run efficiently on shared hosting environments such as Hostinger.

Because of this limitation:

Backend must use:

PHP

Database must use:

MySQL

Avoid technologies requiring persistent server processes such as:

Node.js servers
Python backend frameworks
Self-hosted WebSocket servers

Voice communication must use external WebRTC-based voice APIs.


---

5. User Roles

Regular User

Standard platform user with basic access.

Premium User

Paid user with additional features such as:

gender preference matching
longer call durations
reduced advertisements

Super Admin

Administrator with full control over the platform.


---

6. User Registration & Authentication

Users can create accounts using:

Phone number with OTP verification
Email and password
Google login

During signup users must provide:

Gender
Preferred languages
Age confirmation (18+)


---

7. Language System

Users must select one or more preferred languages.

Supported languages include global languages and Indian languages.

Global Languages

English
Spanish
Portuguese
French
German
Arabic
Russian
Japanese

Indian Languages

Hindi
Tamil
Telugu
Malayalam
Kannada
Marathi
Gujarati
Bengali
Punjabi

Users can select multiple languages.

Matching prioritizes users sharing at least one common language.


---

8. User Availability System

Users can control when they are available for calls.

Available options:

Always Available
Only When App Is Open
Do Not Disturb

Matching engine only considers users marked as available.


---

9. Home Screen

Main dashboard includes:

Start Call button
Online users indicator
Navigation menu

Navigation tabs:

Home
Call History
Profile
Settings


---

10. Matching Engine

When a user presses Start Call, the system places them into a matching queue.

Matching priority order:

1 Availability status
2 Language compatibility
3 Gender preference (premium users)
4 Subscription priority
5 Queue waiting time


---

11. Matching Algorithm Flow

Step 1
User enters matching queue

Step 2
System checks mutual follow connections

Step 3
Language compatibility filter applied

Step 4
Gender preference filter applied for premium users

Step 5
Subscription priority applied

Step 6
Queue waiting time applied

Step 7
Voice call session created


---

12. Voice Call System

Voice call interface includes:

Voice activity animation
Mute button
End call button
Call duration timer

Displayed information includes:

Anonymous user ID
Gender icon
Language indicator

Voice streaming must use external WebRTC APIs.


---

13. Call Duration System

Example configuration:

Trial Plan – 5 minutes
VIP Plan – 10 minutes
Black Plan – 15 minutes

Call duration limits must be configurable from the admin panel.

Calls automatically disconnect when timer expires.

Users may extend calls using micro payments.


---

14. AI Fallback System

If no matching user is found within a defined time limit, the system may connect an AI voice agent.

The AI agent informs the user that all users are currently busy.

Admin can configure:

AI activation delay
AI call limits
AI scripts


---

15. Call End Options

After a call ends users can:

Rate call
Report user
Block user
Follow user


---

16. Follow and Reconnect System

Users may follow other users after a call.

Reconnect functionality is only available if both users follow each other.

This ensures privacy and prevents harassment.


---

17. Call History

Users can view their call history.

Displayed information:

Call date
Call duration

User identity remains anonymous.


---

18. User Profile

Users can manage:

Profile picture (optional)
Gender
Preferred languages
Subscription status

Users can upgrade subscription plans from the profile page.


---

19. Settings Page

Users can configure:

Availability status
Notification preferences
Logout


---

20. Safety & Moderation

Users can:

Report abusive users
Block users

Automatic moderation includes:

Report threshold detection
Temporary account suspension

Admins can review and reactivate accounts.


---

21. Anti Spam System

The platform must implement spam prevention features.

Examples:

Call cooldown timers
Rate limiting
Abuse detection


---

22. Advertisement System

Supported advertisement formats:

Banner ads
Interstitial ads
Rewarded ads

Example placements:

Home screen banner
Call end interstitial
Rewarded ads for extra minutes

Premium users may experience reduced advertisements.


---

23. Ads Manager (Admin Panel)

Super Admin can manage advertisements through an Ads Manager.

Admin can:

Insert advertisement code
Enable or disable ads
Control ad placements
Configure ad frequency

Supported networks include:

Google AdSense
AdMob
Unity Ads
Custom ad networks

Ads must work without modifying application code.


---

24. Subscription Plans

Example plans:

Trial
VIP
Black

Admin can configure:

Price
Duration
Features
Call duration limits
Advertisement removal


---

25. Payment Gateway System

Multiple global payment gateways must be supported.

Examples include:

Stripe
PayPal
Razorpay
PhonePe
UPI

Admin can configure payment gateways by entering API credentials in the admin panel.


---

26. Super Admin Panel

Admin panel capabilities:

User management
Report moderation
Subscription management
Payment gateway configuration
Ads manager
AI agent control
Language management
Platform settings


---

27. Admin Dashboard Metrics

Dashboard should display:

Total users
Online users
Calls per day
Revenue statistics
Active subscriptions


---

28. Logging System

Platform must maintain logs including:

Call session logs
Error logs

These logs help maintain stability and debugging.


---

29. Database Core Tables

Users
Queue
CallSessions
Reports
Follows
Subscriptions
Payments
AI_Agents
Notifications
Settings
Blocks


---

30. Technical Stack

Backend

PHP

Database

MySQL

Frontend

HTML
CSS
JavaScript

Voice Communication

External WebRTC API


---

31. Performance Strategy

The system must remain lightweight and efficient.

Key strategies include:

Efficient MySQL queries
Queue-based matching
External APIs for heavy processing


---

32. Future Expansion

Possible future features:

Interest-based matching
Voice filters
Gamification
Native mobile applications