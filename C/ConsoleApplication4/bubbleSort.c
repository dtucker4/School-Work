void bubbleSort(int list[], int last)
{
	// Local Definitions
	int temp;
	// Statements
	// Each iteration is one sort pass
	for (int current = 0, sorted = 0;
	current <= last && !sorted;
		current++)
		for (int walker = last, sorted = 1;
	walker > current;
		walker--)
			if (list[walker] < list[walker - 1])
				// Any exchange means list is not sorted
			{
				sorted = 0;
				temp = list[walker];
				list[walker] = list[walker - 1];
				list[walker - 1] = temp;
			} // if
	return;
} // bubbleSort