void shellSort(int list[], int last)
{
	// Local Definitions
	int hold;
	int incre;
	int walker;
	// Statements
	incre = last / 2;
	while (incre != 0)
	{
		for (int curr = incre; curr <= last; curr++)
		{
			hold = list[curr];
			walker = curr - incre;
			while (walker >= 0 && hold < list[walker])
			{
				// Move larger element up in list
				list[walker + incre] = list[walker];
				// Fall back one partition
				walker = (walker - incre);
			} // while
			  // Insert hold in proper position
			list[walker + incre] = hold;
		} // for walk
		  // End of pass--calculate next increment.
		incre = incre / 2;
	} // while
	return;
} // shellSort